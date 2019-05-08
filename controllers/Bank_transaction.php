<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_transaction extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}
    public function getTransactionCharges(){
        /*$this->db->select("BankTransferId,BankId,Amount");
        $this->db->from('banktransfercharges');
        $this->db->where('BankTransferId',$_POST['transType']);
        $this->db->where('BankId',$_POST['fromBankId']);
        $data['charges'] = $this->db->get()->row();*/
        $this->db->select("b.BankTransferId,b.BankId,b.Amount,bm.BankId,bm.InCom");
        $this->db->from('banktransfercharges b');
        $this->db->join('bankmaster bm','b.BankId=bm.BankId');
        //$this->db->where('bm.BankId',$_POST['fromBankId']);
        $this->db->where('b.BankTransferId',$_POST['transType']);
        $this->db->where('b.BankId',$_POST['fromBankId']);
        $data['charges'] = $this->db->get()->row();
       //$data['charges'] = $this->all_model->getTransferTypeAmount($id);
        echo json_encode($data);
    }
    public function getTransactionCharges1($id){
        $data['charges'] = $this->all_model->getTransferTypeAmount1($id);
        echo json_encode($data);
    }
        
	public function index(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
        $data['banks'] = $this->all_model->get_all_banks();
        $data['transType'] = $this->all_model->getTransferType();
		$data['allTransaction'] = $this->all_model->getAllBankTransaction();

		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
        $this->load->view('templates/content');
		$this->load->view('bank_transaction',$data);
		$this->load->view('templates/footer');
	}
    public function bankTransaction(){
        $data['banks'] = $this->all_model->get_all_banks();
        $data['transType'] = $this->all_model->getTransferType();
        $data['allTransaction'] = $this->all_model->getAllBankTransaction();
        $this->load->view('bank_transaction',$data);
    }
    public function addBankTransction(){
        if (!isset($_SESSION['logged_in'])) {
            redirect('login');
        }
        $this->form_validation->set_rules ( 'fromBank', 'From Bank', 'trim|required' );
        $this->form_validation->set_rules ( 'toBank', 'To Bank', 'trim|required' );
        $this->form_validation->set_rules ('amount', 'Amount', 'trim|required');
        $this->form_validation->set_rules ('transType', 'Transfer Type', 'trim|required');
        if ($this->form_validation->run () === FALSE) {
            $data['banks'] = $this->all_model->get_all_banks();
            $data['transType'] = $this->all_model->getTransferType();
            
            $this->load->view('templates/header');
            $this->load->view('templates/left-sidebar');
            $this->load->view('bank_transaction',$data);
            $this->load->view('templates/footer');
        }else{  
                //print_r($_POST);exit();
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;

                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
                $log = "Transaction ID:" . $transactionId  .' : ' . "Add-Bank-Trans" .' - ' . "Created By: ". $userName . PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Bank-Trans". PHP_EOL
                . "Add-Bank-Trans-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );

                $token = $this->input->post('bank_transaction');
                $session_token=null;
                $session_token = $_SESSION['bank_transaction'];
                if(!empty($token) == $session_token){   
                    $date = date('Y-m-d H:i:s');
                    $fromBank = $this->input->post('fromBank');
                    $toBank = $this->input->post('toBank');
                    $amount = str_replace(',','',$this->input->post('amount'));
                    $transType= $this->input->post('transType');
                    //$transferAmt = str_replace(',','',$this->input->post('transferAmt'));
                    $transferAmt = $this->input->post('transferCharges');
                    $uid = $this->input->post('userid');
                    $bankInflowComm = $this->input->post('bankInflowComm');

                    $this->db->select('BankId,BankName,Balance,OctComP,CurId');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$fromBank);
                    $fromBankBal = $this->db->get()->row();
                    
                    $fromBankCurr = $fromBankBal->CurId;
                    if ($fromBankCurr == 2) {
                        $cur = 'USD';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        $from_exchange_rate = $val->rates->EUR;
                        $from_euro_amount = $amount * $from_exchange_rate;
                    }else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $from_exchange_rate = $val->rates->EUR;
                        $from_euro_amount = $amount * $from_exchange_rate;
                    }
                   /* echo $from_euro_amount;
                    echo '<br>';*/

                    $this->db->select('BankId,BankName,Balance,InComP,CurId');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$toBank);
                    $toBankBal = $this->db->get()->row();
                    $toBankCurr = $toBankBal->CurId;
                    if ($toBankCurr == 2) {
                        $cur = 'USD';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        $to_exchange_rate = $val->rates->EUR;
                        $to_euro_amount = $amount * $to_exchange_rate;
                    }else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $to_exchange_rate = $val->rates->EUR;
                        $to_euro_amount = $amount * $to_exchange_rate;
                        //print_r(number_format((float)$euro_amount, 2, '.', ''));
                    }
                    /*echo $to_euro_amount;
                    exit();*/
                    if ($from_exchange_rate > 1 ) {
                        $rate = $from_exchange_rate;
                    }else if($to_exchange_rate > 1){
                        $rate = $to_exchange_rate;
                    }
                    if($from_euro_amount != $amount){
                        $conversion_amount = $from_euro_amount;
                        
                    }else if($to_euro_amount != $amount){
                        $conversion_amount = $to_euro_amount;
                    }else if ($conversion_amount == "") {
                        $conversion_amount = 0;
                    }
                    
                    if ($fromBankCurr == 1 && $toBankCurr == 1) {        // if From and To Bank is EUR 
                       $outgoFees = ($fromBankBal->OctComP*$amount);          //10*1000 = 10000
                       $outgoFees = ($outgoFees/100);                         // (10000/100) = 100
                       $moneyOutFees = $transferAmt;                          // 120
                       $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees)); //(3100-(120+1000+100)) = 660 

                       $moneyInFees = ($toBankBal->InComP*$amount);          // 5*1000 = 5000
                       $moneyInFees = ($moneyInFees/100);                    //(5000/100) = 50
                       $tobal = ($amount-$moneyInFees-$bankInflowComm);                      // (1000-50) = 950
                       $toNewBal = ($toBankBal->Balance)+($tobal);           // (14,748.00+950) = 15698
                    }

                    if ($fromBankCurr == 2 && $toBankCurr == 2) {                               // if From and To Bank is USD
                       $outgoFees = ($fromBankBal->OctComP*$amount);                            //10*1000 = 10000
                       $outgoFees = ($outgoFees/100);                                           // (10000/100) = 100
                       $moneyOutFees = $transferAmt;                                            // 120
                       $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees)); //(1,880.00-(120+1000+100)) = 660 

                       $moneyInFees = ($toBankBal->InComP*$amount);          // 5*1000 = 5000
                       $moneyInFees = ($moneyInFees/100);                    //(5000/100) = 50
                       $tobal = ($amount-$moneyInFees-$bankInflowComm);                      // (1000-50) = 950
                       $toNewBal = ($toBankBal->Balance)+($tobal);           // (15698+950) = 16648
                    }

                    if ($fromBankCurr == 2 && $toBankCurr == 1) {    // if From Bank is USD and To Bank is EUR
                       $outgoFees = ($fromBankBal->OctComP*$amount);          //10*1000 = 10000
                       $outgoFees = ($outgoFees/100);                         // (10000/100) = 100
                       $moneyOutFees = $transferAmt;                          // 120
                       $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees)); //(660-(120+1000+100)) = 660 

                       $moneyInFees = ($toBankBal->InComP*$to_euro_amount);          // 5*1000 = 5000
                       $moneyInFees = ($moneyInFees/100);                    //(5000/100) = 50
                       $tobal = ($to_euro_amount-$moneyInFees-$bankInflowComm);                      // (1000-50) = 950
                       $toNewBal = ($toBankBal->Balance)+($tobal);           // (16,648.00+950) = 16537.48
                       /*echo 'fromNewBal' . $fromNewBal;
                       echo '<br>';
                       echo 'toNewBal' . $toNewBal;
                       exit();*/
                    }

                    if ($fromBankCurr == 1 && $toBankCurr == 2) {                                 // if From Bank is EUR and To Bank is USD
                       $outgoFees = ($fromBankBal->OctComP*$amount);          //10*1000 = 10000
                       $outgoFees = ($outgoFees/100);                         // (10000/100) = 100
                       $moneyOutFees = $transferAmt;                          // 120
                       $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees)); //(3100-(120+1000+100)) = 1880 

                       $moneyInFees = ($toBankBal->InComP*$to_euro_amount);          // 5*883.107 = 4415.535
                       $moneyInFees = ($moneyInFees/100);                           //(4415.535/100) = 44.15535
                       $tobal = ($to_euro_amount-$moneyInFees-$bankInflowComm);                      // (883.107-44.15535) = 838.95165
                       $toNewBal = ($toBankBal->Balance)+($tobal);                   // (17,598.00+838.95165) = 18436.9516
                    }



                    /*echo 'conversion_amount ' . $conversion_amount;
                    echo '</br>';
                    echo 'toNewBal ' . $toNewBal;*/
                    
                    /*$outgoFees = ($fromBankBal->OctComP*$from_euro_amount); //(10*883.412)
                    $outgoFees = ($outgoFees/100);                          //(8834.12/100) = 112.4613*/
                    /*$moneyOutFees = ($transferAmt*$amount);
                    $moneyOutFees = ($moneyOutFees/100);*/
                    /*$moneyOutFees = $transferAmt;                           //(120)
                    $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$from_euro_amount+$outgoFees));  //(3,100.00-(120+883.412+88.3412)) = 2008.2468*/
                    

                    
                    
                    /*$moneyInFees = ($toBankBal->InComP*$to_euro_amount);    // (5*1000)
                    $moneyInFees = ($moneyInFees/100);                      // (5000/100) = 50

                    $tobal = ($to_euro_amount-$moneyInFees);                //(1000-50)
                    $toNewBal = ($toBankBal->Balance)+($tobal);             //(14,748.00+950) = 15698*/


                    $bankTrans = array(
                        'FromBank' => $fromBank,
                        'Amount' => $amount,
                        'BankTransferId' => $transType,
                        'MoneyOutFees' => $moneyOutFees,
                        'ToBank' => $toBank,
                        'MoneyInFees' => $moneyInFees,
                        'ExchangeRate' => $rate,
                        'EuroValue' => $conversion_amount,
                        'CreatedOn' => $date,
                        'CreatedBy' => $uid
                    );

                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Bank-Trans". PHP_EOL
                    . "Add-Bank-Trans-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($bankTrans) .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );

                    $this->db->insert('banktransaction',$bankTrans);
                    
                    $this->db->where('bankId',$fromBank);
                    $this->db->update('bankmaster',array('Balance'=>$fromNewBal));

                    $this->db->where('bankId',$toBank);
                    $this->db->update('bankmaster',array('Balance'=>$toNewBal));
                    $_SESSION['pop_mes'] = "Bank Transaction Added Successfully.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Add-Bank-Trans" . PHP_EOL
                        . "Add-Bank-Trans-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "From-Bank-Balance-Before: " . $fromBankBal->Balance .','.
                        "From-Bank-Out-Commission-Percentage: ".$fromBankBal->OctComP .','."amount: ".$amount .','.
                        "From-Bank-Out Go Fees: ".$outgoFees .','.
                        "From-Bank-Money-Out-Fees: ".$moneyOutFees .','."From-Bank-New-Balance: ".$fromNewBal .','."To-Bank-In-Commission-Percentage: ".$toBankBal->InComP .','."To-Bank-Money-In Fees: ".$moneyInFees .','."To-Bank-New-Balance: ".$toNewBal .','.
                        "Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );

                    redirect('bank-transaction');
                }else{
                    $_SESSION['pop_mes'] = "Token does not match.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Bank-Trans". PHP_EOL
                        . "Add-Bank-Trans-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );
                    redirect('bank-transaction');
                }
        }
    }
    public function update($id){
        if(!isset($_SESSION['logged_in']))
        {
            redirect('login');
        }
        $this->form_validation->set_rules ('fromBank1', 'From Bank', 'trim|required');
        $this->form_validation->set_rules ('toBank1', 'To Bank', 'trim|required' );
        $this->form_validation->set_rules ('amount1', 'Amount', 'trim|required');
        $this->form_validation->set_rules ('transType1', 'Transfer Type', 'trim|required');
        if ($this->form_validation->run () === FALSE) {
            $data['banks'] = $this->all_model->get_all_banks();
            $data['transType'] = $this->all_model->getTransferType();
            $data['getTransaction'] = $this->all_model->getBankTransaction($id);
            $data['charges'] = $this->all_model->getTransferTypeAmount($id);
            $this->load->view('edit-bank-transaction',$data);
        }else{  
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;

                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
                $log = "Transaction ID:" . $transactionId  .' : ' . "Edit-Bank-Trans" .' - ' . "Created By: ". $userName . PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Bank-Trans". PHP_EOL
                . "Edit-Bank-Trans-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );

                $token = $this->input->post('editbanktrans_token');
                $session_token=null;
                $session_token = $_SESSION['edit_banktrans'];
                if(!empty($token) == $session_token){
                    $fromBank = $this->input->post('fromBank1');
                    $toBank = $this->input->post('toBank1');
                    $amount = str_replace(',','',$this->input->post('amount1'));
                    $transType= $this->input->post('transType1');
                    $transferAmt = str_replace(',','',$this->input->post('transferCharges1'));
                    $uid = $this->input->post('userid');

                    $this->db->select('BankId,BankName,Balance,OctComP,CurId');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$fromBank);
                    $fromBankBal = $this->db->get()->row();

                    $this->db->select('b.BankId,bc.BankTransferId,bc.BankId,bc.Amount');
                    $this->db->from('bankmaster b');
                    $this->db->join('banktransfercharges bc','bc.BankId = b.BankId');
                    $this->db->where('bc.BankTransferId',$transType);
                    $this->db->where('b.BankId',$fromBank);
                    $fromBankTransferAmt = $this->db->get()->row();
                    /*if ($fromBankTransferAmt > 0) {
                        $transferAmt = $fromBankTransferAmt->Amount;
                    }else{
                        $transferAmt = 0;
                    }*/
                    //$transferAmt = $fromBankTransferAmt->Amount;
                    /*echo 'transferAmt:'.$transferAmt;
                    echo '<br>';*/

                    $this->db->select('BankId,BankName,Balance,InComP,CurId');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$toBank);
                    $toBankBal = $this->db->get()->row();
                    $toBankCurr = $toBankBal->CurId;

                    $this->db->select('TransId,FromBank,Amount,BankTransferId,ToBank,EuroValue');
                    $this->db->from('banktransaction');
                    $this->db->where('TransId',$id);
                    $beforeBalance = $this->db->get()->row();
                    //$beforeBalance = $beforeBalance->Amount;

                    /*$outgoFees = ($fromBankBal->OctComP*$amount);
                    $outgoFees = ($outgoFees/100);
                    $moneyOutFees = ($transferAmt*$amount);
                    $moneyOutFees = ($moneyOutFees/100);*/
                    $fromBankCurr = $fromBankBal->CurId;
                    if ($fromBankCurr == 2) {
                        $cur = 'USD';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $from_exchange_rate = $val->rates->EUR;
                        $from_euro_amount = $amount * $from_exchange_rate;
                    }else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $from_exchange_rate = $val->rates->EUR;
                        $from_euro_amount = $amount * $from_exchange_rate;
                    }

                    if ($toBankCurr == 2) {
                        $cur = 'USD';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        $to_exchange_rate = $val->rates->EUR;
                        $to_euro_amount = $amount * $to_exchange_rate;
                    }else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        $to_exchange_rate = $val->rates->EUR;
                        $to_euro_amount = $amount * $to_exchange_rate;
                        //print_r(number_format((float)$euro_amount, 2, '.', ''));
                    }
                    if ($from_exchange_rate > 1 ) {
                        $rate = $from_exchange_rate;
                    }else if($to_exchange_rate > 1){
                        $rate = $to_exchange_rate;
                    }
                    if($from_euro_amount != $amount){
                        $conversion_amount = $from_euro_amount;
                        
                    }else if($to_euro_amount != $amount){
                        $conversion_amount = $to_euro_amount;
                    }else if ($conversion_amount == "") {
                        $conversion_amount = 0;
                    }



                    if ($fromBankCurr == 1 && $toBankCurr == 1) {           // if From and To Bank is EUR 
                        $fromNewBal = ($fromBankBal->Balance+($beforeBalance->Amount-$amount));  // (1,880.00+(800-1000)) = 1680

                        $toNewBal1 = ($toBankBal->Balance-$beforeBalance->Amount);   // (18,436.95 - 800) = 17636.95
                        $toNewBal = ($toNewBal1+$amount);            // (17636.95+1000) = 18636.95  
                    }

                    if ($fromBankCurr == 2 && $toBankCurr == 2) {         // if From and To Bank is USD 
                        $fromNewBal = ($fromBankBal->Balance+($beforeBalance->Amount-$amount));  // (1,680.00+(1000-1200)) = 1480

                        $toNewBal1 = ($toBankBal->Balance-$beforeBalance->Amount);   // (18,636.95 - 1000) = 17636.95
                        $toNewBal = ($toNewBal1+$amount);            // (17636.95+1200) = 18836.95
                    }

                    if ($fromBankCurr == 2 && $toBankCurr == 1) {         // if From BAnk is USD and To Bank is Eur
                        $fromNewBal = ($fromBankBal->Balance+($beforeBalance->Amount-$amount));  // (1,680.00+(1000-1200)) = 1480

                        $toNewBal1 = ($toBankBal->Balance-$beforeBalance->Amount);   // (20,986.95 - 1000) = 19986.95
                        $toNewBal = ($toNewBal1+$amount);            // (19986.95+1200) = 21186.95
                    }

                    if ($fromBankCurr == 1 && $toBankCurr == 2) {         // if From Bank is EUR and To BAnk is USD
                        $fromNewBal = ($fromBankBal->Balance+($beforeBalance->Amount-$amount));  // (1,880.00+(1000-1200)) = 1680

                        $toNewBal1 = ($toBankBal->Balance-$beforeBalance->EuroValue);   // (20,380.13 - 883.22) = 19496.91
                        $toNewBal = ($toNewBal1+$to_euro_amount);            // (19496.91+1,060.13) = 20557.04
                    }

                    //$fromNewBal = ($fromBankBal->Balance+($beforeBalance-$from_euro_amount));  // (2,008.25+(883.41-800)) = 2354.99

                    //$fromNewBal = ($fromNewBal1-$amount);
                    //$fromNewBal = ($fromNewBal1+$amount);
                   // $fromNewBal = ($moneyOutFees+$fromNewBal1+$outgoFees);
                    //$fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees));
                   /* echo 'outgoFees:'.$outgoFees;
                    echo '<br>';
                    echo 'moneyOutFees:'.$moneyOutFees;
                    echo '<br>';
                    echo 'fromNewBalbefore:'.$fromNewBal1;
                    echo '<br>';
                    echo 'fromNewBal:'.$fromNewBal;
                    echo '<br>';
                    exit();*/
                    /*$toNewBal1 = ($toBankBal->Balance-$beforeBalance);   // (16,042.15 - 1350.38)
                    $toNewBal = ($toNewBal1+$to_euro_amount);            // (14691.77+899.69) = 15591.46   // if amount changed to 1200 to 800*/
                    /*$moneyInFees = ($toBankBal->InComP*$amount);
                    $moneyInFees = ($moneyInFees/100);
                    

                    $toNewBal = ($toBankBal->Balance+($amount-$moneyInFees));*/

                    

                    $bankTrans = array(
                        'FromBank' => $fromBank,
                        'Amount' => $amount,
                        'BankTransferId' => $transType,
                        'ToBank' => $toBank,
                        'ExchangeRate' => $rate,
                        'EuroValue' => $conversion_amount,
                        'ModifiedBy' => $uid
                    );
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Bank-Trans". PHP_EOL
                    . "Edit-Bank-Trans-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($bankTrans) .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );

                    $this->db->where('TransId',$id);
                    $this->db->update('banktransaction',$bankTrans);

                    $this->db->where('bankId',$fromBank);
                    $this->db->update('bankmaster',array('Balance'=>$fromNewBal));

                    $this->db->where('bankId',$toBank);
                    $this->db->update('bankmaster',array('Balance'=>$toNewBal));
                    $_SESSION['pop_mes'] = "Bank Transaction Updated Successfully.";
                     $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-Bank-Trans" . PHP_EOL
                        . "Edit-Bank-Trans-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "From-Bank-Balance-Before: " . $fromBankBal->Balance .','.
                        "From-Bank-Out-Commission-Percentage: ".$fromBankBal->OctComP .','."amount: ".$amount .','.
                        "From-Bank-Out Go Fees: ".$outgoFees .','.
                        "From-Bank-Money-Out-Fees: ".$moneyOutFees .','."From-Bank-New-Balance: ".$fromNewBal .','."To-Bank-In-Commission-Percentage: ".$toBankBal->InComP .','."To-Bank-Money-In Fees: ".$moneyInFees .','."To-Bank-New-Balance: ".$toNewBal .','.
                        "Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_banktrans, $log . "\n", FILE_APPEND );
                    return 1;
                }else{
                    $_SESSION['pop_mes'] = "Token does not match.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Bank-Trans". PHP_EOL
                        . "Edit-Bank-Trans-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( 'Logs/banktrans.txt', $log . "\n", FILE_APPEND );
                    return 1;
                }
        }
    }

}
