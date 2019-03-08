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
        $this->db->select("BankTransferId,BankId,Amount");
        $this->db->from('banktransfercharges');
        $this->db->where('BankTransferId',$_POST['transType']);
        $this->db->where('BankId',$_POST['fromBankId']);
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
		$this->load->view('templates/left-sidebar');
		$this->load->view('bank_transaction',$data);
		$this->load->view('templates/footer');
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

                    $this->db->select('BankId,BankName,Balance,OctComP');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$fromBank);
                    $fromBankBal = $this->db->get()->row();
                    
                    /*$this->db->select('b.BankId,bc.BankTransferId,bc.BankId,bc.Amount');
                    $this->db->from('bankmaster b');
                    $this->db->join('banktransfercharges bc','bc.BankId = b.BankId');
                    $this->db->where('bc.BankTransferId',$transType);
                    $this->db->where('b.BankId',$fromBank);
                    $fromBankTransferAmt = $this->db->get()->row();
                    //print_r($fromBankTransferAmt);exit();
                    if ($fromBankTransferAmt > 0) {
                        $transferAmt = $fromBankTransferAmt->Amount;
                    }else{
                        $transferAmt = 0;
                    }*/
/*
                    if ($fromBankBal > 0) {
                        $OctComP = $fromBankBal->OctComP;
                    }else{
                        $OctComP = 0;
                    }*/
                    /*print_r($fromBankBal);
                    echo '<br>';
                    print_r($transferAmt);
                    echo '<br>';
                    exit();*/

                    $this->db->select('BankId,BankName,Balance,InComP');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$toBank);
                    $toBankBal = $this->db->get()->row();


                    
                    /*$moneyOutFees = ($transferAmt*$amount);
                    $moneyOutFees = ($moneyOutFees/100);

                    $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount));*/
                    
                    $outgoFees = ($fromBankBal->OctComP*$amount);
                    $outgoFees = ($outgoFees/100);
                    /*$moneyOutFees = ($transferAmt*$amount);
                    $moneyOutFees = ($moneyOutFees/100);*/
                    $moneyOutFees = $transferAmt;
                    $fromNewBal = ($fromBankBal->Balance-($moneyOutFees+$amount+$outgoFees));
                    /*echo 'outgoFees:'.$outgoFees;
                    echo '<br>';
                    echo 'moneyOutFees:'.$moneyOutFees;
                    echo '<br>';
                    echo 'fromNewBal:'.$fromNewBal;
                    echo '<br>';
                    exit();*/
                    
                    
                    $moneyInFees = ($toBankBal->InComP*$amount);
                    $moneyInFees = ($moneyInFees/100);

                    $tobal = ($amount-$moneyInFees);
                    $toNewBal = ($toBankBal->Balance)+($tobal);

                    $bankTrans = array(
                        'FromBank' => $fromBank,
                        'Amount' => $amount,
                        'BankTransferId' => $transType,
                        'MoneyOutFees' => $moneyOutFees,
                        'ToBank' => $toBank,
                        'MoneyInFees' => $moneyInFees,
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
                    $_SESSION['pop_mes'] = "Token does not matched.";
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

                    $this->db->select('BankId,BankName,Balance,OctComP');
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

                    $this->db->select('BankId,BankName,Balance,InComP');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$toBank);
                    $toBankBal = $this->db->get()->row();

                    $this->db->select('TransId,FromBank,Amount,BankTransferId,ToBank');
                    $this->db->from('banktransaction');
                    $this->db->where('TransId',$id);
                    $beforeBalance = $this->db->get()->row();
                    $beforeBalance = $beforeBalance->Amount;
                    /*echo 'beforeBalance:'.$beforeBalance;
                    echo '<br>';*/

                    /*$outgoFees = ($fromBankBal->OctComP*$amount);
                    $outgoFees = ($outgoFees/100);
                    $moneyOutFees = ($transferAmt*$amount);
                    $moneyOutFees = ($moneyOutFees/100);*/

                    
                    $fromNewBal = ($fromBankBal->Balance+($beforeBalance-$amount));
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
                    $toNewBal1 = ($toBankBal->Balance-$beforeBalance);
                    $toNewBal = ($toNewBal1+$amount);
                    /*$moneyInFees = ($toBankBal->InComP*$amount);
                    $moneyInFees = ($moneyInFees/100);
                    

                    $toNewBal = ($toBankBal->Balance+($amount-$moneyInFees));*/

                    

                    $bankTrans = array(
                        'FromBank' => $fromBank,
                        'Amount' => $amount,
                        'BankTransferId' => $transType,
                        'ToBank' => $toBank,
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
                    $_SESSION['pop_mes'] = "Token does not matched.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Bank-Trans". PHP_EOL
                        . "Edit-Bank-Trans-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( 'Logs/banktrans.txt', $log . "\n", FILE_APPEND );
                    return 1;
                }
        }
    }

}
