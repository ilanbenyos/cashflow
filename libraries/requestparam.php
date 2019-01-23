<?php 
class data
{
	
	public $name;
	public $description;
	public $price;
	public $category_id;
	public $created;
}

/*
class TradeRecord
{
	
	public $MarginRate;
	public $GwClosePrice;
	public $GwOpenPrice;
	public $Activation;
	public $GwOrder;
	public $Comment;
	public $Magic;
	public $Taxes;
	public $Profit;
	public $ClosePrice;
	public $Storage;
	public $CommissionAgent;
	public $Commission;
	public $ConvRates;
	public $Reason;
	public $Expiration;
	public $GwVolume;
	public $CloseTime;
	public $Tp;
	public $Sl;
	public $OpenPrice;
	public $State;
	public $OpenTime;
	public $Volume;
	public $Cmd;
	public $Digits;
	public $Symbol;
	public $Login;
	public $Order;
	public $Timestamp;
	public $ApiData;
}
*/
class char {
}

class duration {
}

class guid {
}

class IntPtr {
	public $any; // <anyXML>
	public $FactoryType; // QName
}

class CrmGetAllAccountDetailsRequestModel
{
	public $ownerUserId;
	public $organizationName;
	public $businessUnitName;

	public $accountDetailsRequestFilterType;
	public $email;
	public $tradingPlatformAccountName;

}


class UpdateAccountCronRequestModel
{
	public $organizationName;
	public $businessUnitName;
	public $ownerUserId;

	public $uscitizen_other;
	public $tax_residency;
	public $text1;
	public $text2;
	public $education;
	public $AccountTitle;
	public $trading_experience;
	public $pref_language;
	public $province;
	public $income_source;
	public $trading_frequency;
	public $trading_volume;
	public $purpose_trans;
	public $addinfos;
	public $net_worth;
	public $income;
	public $text;
	public $pid;
	public $ped;
	public $text21;
	public $turnoverperyear;




	public $approveReceiveCommercial;

	public $account_id;
	public $place_of_birth;
	public $passed_appropriateness_test;
	public $requested_higher_leverage;



	 
}

class JointAccountRequestModel
{
	public $organizationName;
	public $businessUnitName;
	public $ownerUserId;

	public $approveReceiveCommercial;
	public $accountId;
	public $acceptTermsandConditions;


	public $addinfos;
	public $text1;
	public $text2;
	public $p_rel_pub_pos;
	public $s_rel_pub_pos;
	public $p_title;
	public $s_title;
	public $p_gender;
	public $s_gender;
	public $p_income_source;
	public $s_income_source;
	public $p_gross_income;
	public $s_gross_income;
	public $p_net_worth;
	public $s_net_worth;
	public $p_pur_of_trans;
	public $s_pur_of_trans;
	public $p_trade_size;
	public $s_trade_size;
	public $p_acc_turnover;
	public $s_acc_turnover;
	public $p_trade_past;
	public $s_trade_past;
	public $p_trade_exp;
	public $s_trade_exp;
	public $p_cfd;
	public $s_cfd;
	public $p_curriencies;
	public $s_curriencies;
	public $p_future;
	public $s_future;
	public $typeofaccount;
	public $p_firstname;
	public $s_firstname;
	public $p_lastname;
	public $s_lastname;
	public $p_pob;
	public $s_pob;
	public $p_nationality;
	public $s_nationality;
	public $p_pid;
	public $s_pid;
	public $p_ped;
	public $s_ped;
	public $p_address;
	public $s_address;
	public $p_city;
	public $s_city;
	public $p_zip;
	public $s_zip;
	public $p_phone;
	public $s_phone;
	public $p_mob;
	public $s_mob;
	public $p_email;
	public $s_email;
	public $p_pco;
	public $s_pco;
	public $p_options;
	public $p_secu;
	public $s_options;
	public $s_secu;
	public $pr_uscitizen;
	public $se_uscitizen;
	public $s_uscitizen_other;
	public $p_uscitizen_other;

}

class CorporateAccountRequestModel
{
	public $organizationName;
	public $businessUnitName;
	public $ownerUserId;

	public $approveReceiveCommercial;
	public $accountId;
	public $c_country;

	public $bu_criteria;
	public $bankrupcy;
	public $us_citizen_other;
	public $tax_residency;
	public $pr_uscitizen;
	public $personal_accets;
	public $trans_in_last_year;
	public $exp_in_service_sector;
	public $secu_exp;
	public $secu_freq_trade;
	public $options_exp;
	public $options_freq_trades;
	public $commodities_exp;
	public $commodities_freq_trade;
	public $future_exp;
	public $future_treq_trade;
	public $curr_exp;
	public $curr_frq_trade;
	public $cfd_exp;
	public $cfd_freq_trades;
	public $spread_bets_exp;
	public $spread_bets_freq_of_trade;
	public $irs;
	public $typeofaccount;
	public $c_name;
	public $c_address;
	public $c_city;
	public $c_zip;
	public $c_phone;
	public $tax_id;
	public $giin;
	public $lei;
	public $pos_in_company;
	public $addinfos;

}

class UserRecord {
	public $address; // string
	public $agent_account; // int
	public $api_data; // string
	public $balance; // double
	public $balance_status; // int
	public $city; // string
	public $comment; // string
	public $country; // string
	public $credit; // double
	public $email; // string
	public $enable; // int
	public $enable_change_password; // int
	public $enable_read_only; // int
	public $enable_reserved; // ArrayOfint
	public $group; // string
	public $id; // string
	public $interestrate; // double
	public $lastdate; // int
	public $leverage; // int
	public $login; // int
	public $name; // string
	public $password; // string
	public $password_investor; // string
	public $password_phone; // string
	public $phone; // string
	public $prevbalance; // double
	public $prevequity; // double
	public $prevmonthbalance; // double
	public $prevmonthequity; // double
	public $publickey; // string
	public $regdate; // int
	public $reserved; // int
	public $reserved2; // ArrayOfdouble
	public $send_reports; // int
	public $state; // string
	public $status; // string
	public $taxes; // double
	public $timestamp; // int
	public $unused; // string
	public $user_color; // unsignedInt
	public $zipcode; // string
}

class TradeRecord {
	public $activation; // int
	public $close_price; // double
	public $close_time; // int
	public $cmd; // int
	public $comment; // string
	public $commission; // double
	public $commission_agent; // double
	public $conv_rates; // ArrayOfdouble
	public $conv_reserv; // int
	public $digits; // int
	public $expiration; // int
	public $internal_id; // int
	public $login; // int
	public $magic; // int
	public $margin_rate; // double
	public $next; // IntPtr
	public $open_price; // double
	public $open_time; // int
	public $order; // int
	public $profit; // double
	public $reserved; // ArrayOfint
	public $sl; // double
	public $spread; // int
	public $state; // int
	public $storage; // double
	public $symbol; // string
	public $taxes; // double
	public $timestamp; // int
	public $tp; // double
	public $value_date; // int
	public $volume; // int
}

class MT4ValidateUser {
	public $userid; // int
	public $pass; // string
}

class MT4ValidateUserResponse {
	public $MT4ValidateUserResult; // int
}

class MT4SetPass {
	public $userid; // int
	public $pass; // string
}

class MT4SetPassResponse {
	public $MT4SetPassResult; // int
}

class MT4CreateUser {
	public $name; // string
	public $pwd; // string
	public $country; // string
	public $state; // string
	public $addr; // string
	public $email; // string
	public $balance; // int
	public $comment; // string
	public $credit; // int
	public $group; // string
}

class MT4CreateUserResponse {
	public $MT4CreateUserResult; // int
}

class MT4UpdateUser {
	public $logincode; // int
	public $name; // string
	public $pwd; // string
	public $country; // string
	public $state; // string
	public $addr; // string
	public $email; // string
	public $balance; // int
	public $comment; // string
	public $credit; // int
	public $group; // string
}

class MT4UpdateUserResponse {
	public $MT4UpdateUserResult; // int
}

class MT4GetUser {
	public $logincode; // int
}

class MT4GetUserResponse {
	public $MT4GetUserResult; // UserRecord
}

class MT4GetUserTrades {
	public $logincode; // int
	public $datefrom; // long
	public $dateto; // long
}

class MT4GetUserTradesResponse {
	public $MT4GetUserTradesResult; // ArrayOfTradeRecord
}

class MT4GetUserTrades2 {
	public $login; // int
	public $dateFrom; // int
	public $monthFrom; // int
	public $yearFrom; // int
	public $dateTo; // int
	public $monthTo; // int
	public $yearTo; // int
}

class MT4GetUserTrades2Response {
	public $MT4GetUserTrades2Result; // ArrayOfTradeRecord
}

class MT4GetUserDeposits {
	public $login; // int
	public $dateFrom; // int
	public $monthFrom; // int
	public $yearFrom; // int
	public $dateTo; // int
	public $monthTo; // int
	public $yearTo; // int
}

class MT4GetUserDepositsResponse {
	public $MT4GetUserDepositsResult; // ArrayOfTradeRecord
}


/**
 * MT4Service class
 *
 *
 *
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class MT4Service extends SoapClient {

	private static $classmap = array(
			'char' => 'char',
			'duration' => 'duration',
			'guid' => 'guid',
			'IntPtr' => 'IntPtr',
			'UserRecord' => 'UserRecord',
			'TradeRecord' => 'TradeRecord',
			'MT4ValidateUser' => 'MT4ValidateUser',
			'MT4ValidateUserResponse' => 'MT4ValidateUserResponse',
			'MT4SetPass' => 'MT4SetPass',
			'MT4SetPassResponse' => 'MT4SetPassResponse',
			'MT4CreateUser' => 'MT4CreateUser',
			'MT4CreateUserResponse' => 'MT4CreateUserResponse',
			'MT4UpdateUser' => 'MT4UpdateUser',
			'MT4UpdateUserResponse' => 'MT4UpdateUserResponse',
			'MT4GetUser' => 'MT4GetUser',
			'MT4GetUserResponse' => 'MT4GetUserResponse',
			'MT4GetUserTrades' => 'MT4GetUserTrades',
			'MT4GetUserTradesResponse' => 'MT4GetUserTradesResponse',
			'MT4GetUserTrades2' => 'MT4GetUserTrades2',
			'MT4GetUserTrades2Response' => 'MT4GetUserTrades2Response',
			'MT4GetUserDeposits' => 'MT4GetUserDeposits',
			'MT4GetUserDepositsResponse' => 'MT4GetUserDepositsResponse',
	);

	public function MT4Service($wsdl = "http://mt4.forexwebsolution.com/mt4svc/service1.SVC?wsdl", $options = array()) {
		foreach(self::$classmap as $key => $value) {
			if(!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}
		parent::__construct($wsdl, $options);
	}

	/**
	 *
	 *
	 * @param MT4ValidateUser $parameters
	 * @return MT4ValidateUserResponse
	 */
	public function MT4ValidateUser(MT4ValidateUser $parameters) {
		return $this->__soapCall('MT4ValidateUser', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4SetPass $parameters
	 * @return MT4SetPassResponse
	 */
	public function MT4SetPass(MT4SetPass $parameters) {
		return $this->__soapCall('MT4SetPass', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4CreateUser $parameters
	 * @return MT4CreateUserResponse
	 */
	public function MT4CreateUser(MT4CreateUser $parameters) {
		return $this->__soapCall('MT4CreateUser', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4UpdateUser $parameters
	 * @return MT4UpdateUserResponse
	 */
	public function MT4UpdateUser(MT4UpdateUser $parameters) {
		return $this->__soapCall('MT4UpdateUser', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4GetUser $parameters
	 * @return MT4GetUserResponse
	 */
	public function MT4GetUser(MT4GetUser $parameters) {
		return $this->__soapCall('MT4GetUser', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4GetUserTrades $parameters
	 * @return MT4GetUserTradesResponse
	 */
	public function MT4GetUserTrades(MT4GetUserTrades $parameters) {
		return $this->__soapCall('MT4GetUserTrades', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4GetUserTrades2 $parameters
	 * @return MT4GetUserTrades2Response
	 */
	public function MT4GetUserTrades2(MT4GetUserTrades2 $parameters) {
		return $this->__soapCall('MT4GetUserTrades2', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

	/**
	 *
	 *
	 * @param MT4GetUserDeposits $parameters
	 * @return MT4GetUserDepositsResponse
	 */
	public function MT4GetUserDeposits(MT4GetUserDeposits $parameters) {
		return $this->__soapCall('MT4GetUserDeposits', array($parameters),       array(
				'uri' => 'http://tempuri.org/',
				'soapaction' => ''
		)
		);
	}

}

//////////////////////////MT4 Classes////////////////
class CrmRealRequestModel
    {
        public $businessUnitName;
        public $organizationName;
        public $ownerUserId;

        //marketing info
        public $aDData;
        public $adsServer;
        public $affiliate;
        public $affiliateTransactionId;
        public $campaignId;
        public $referrer;
        public $subAffiliate;
        public $tag;
        public $tag1;
        public $tLID;
        public $utmCampaign;
        public $utmContent;
        public $utmCreative;
        public $utmMedium;
        public $utmSource;
        public $utmTerm;
        public $whiteLabel;


        //environment info
        public $ipAddress;
        public $operationSystem;

        //picklist info
        public $accountTypeName;
        public $accountTypeValue;

        public $averageTradeSize;
        public $cfdTradingExperience;
        public $currenciesTradingExperience;
        public $futuresTradingExperience;
        public $howDidYouHearAboutUs;
        public $numberOfTimesTradedInPastYear;
        public $optionsTradingExperience;
        public $securitiesTradingExperience;
        public $title;

        //general
  //      public bool acceptTermsAndConditions;
        public $additionalInfo1;
        public $address;
        public $apiTrading;
        public $city;
        public $dateOfBirth;
        public $email;
        public $estimatedAnnualIncome;
        public $estimatedNetWorth;
        public $firstName;
        public $fullName;
        public $groupName;
        public $hasDemoExperience;
        public $lastName;
        public $loggedInAccountId;
        public $managedAccount;
        public $mobileNumber;
        public $occupation;
        public $password;
        public $phoneAreaCode;
        public $phoneCountryCode;
        public $phoneNumber;
        public $placeOfBirth;
        public $sendSMS;
        public $socialSecurityNumber;
        public $state;
        public $tradingPlatformId; 
        public $zipCode;

        public $countryCode;
        
    }
class Tstatement {
	public $Time;
	public $Amount;
	public $Method;
	public $Currency; // guid
	public $TPAccountName;
	public $Type;


}

class MgtGetAccountBalanceRequestModel {
	public $ApiUserName;
	public $ApiPassword;
	public $userId;
	


}

class MgtGetAccountBalResponseModel {
	public $equity;
	public $margin;
	public $balance;
	public $userId;
	public $credit;



}

class CrmLoginAccountModel
{
	public $organizationName; // string
	public $ownerUserId; //Guid 
	public $businessUnitName; //string
	public $tradingPlatformAccountName; //string
	public $tradingPlatformAccountPassword; //string
	 

}

class CrmDemoRequestModel
{
	public $organizationName; // string
	public $ownerUserId; //Guid
	public $businessUnitName; //string
	public $TradingPlatformId; //Guid
	public $IpAddress; //string
	public $FirstName; //string
	public $LastName; //string
	public $Email; //string
	public $GroupName; //string
	public $PhoneAreaCode; //string
	public $PhoneNumber; //string
	public $PhoneCountryCode; //string
	public $CountryCode; //string
	public $LoggedInAccountId; // guid
	public $password; //string


}

class CrmUpdateUserModel
{
	public $organizationName;//string
	public $ownerUserId; //Guid
	public $businessUnitName; //string
	public $firstName; //string
	public $lastName; //string
	public $email; //string
	public $countryId;//Guid
	public $phoneNumber; //string
	public $address1; //string
	public $city;//string
	public $zipCode;//string
	public $phoneCountryCode; //string
	public $phoneAreaCode;//string
	public $accountId; //Guid
}

class CrmGetTradingHistoryModel
{
	public $organizationName; //string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $tradingPlatformAccountId;//Guid
	public $startTime;//DateTime
	public $endTime;//DateTime
	public $maxRows;//int

}
class Thistory {
	public $ActionType;
	public $Amount;
	public $CloseRate;
	public $CloseTime;
	public $InstrumentName;
	public $ProfitInAccountCurrency;
}
class Thistory2 {
	public $ActionType;
	public $Amount;
	public $CloseRate;
	public $CloseTime; // guid
	public $InstrumentName;
	public $ProfitInAccountCurrency; // double
}

class CrmChangePasswordRequestModel
{
	public $organizationName;//string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $tpName;//string
	public $oldPassword;//string
	public $newPassword;//string

	 
}

class CrmForgotRequestPasswordModel
{
	public $organizationName;//string 
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $tpName;//string
	public $email;//string
}


class CrmUploadFileModel
{
	public $organizationName;//string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $accountId;//Guid
	public $fileName;//string
	public $fileContent;//string

	 
}

class CrmCreateWithdrawalRequestModel
{
	public $organizationName;//string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $tradingPlatformAccountName;//string
	public $withdrawalMethod;//MoneyTransactionMethod
	public $accountId;//Guid
	public $currencyId;//Guid
	public $email;//string
	public $cardExpirationMonth;//string
	public $cardExpirationYear;//string
	public $cardHolderName;//string
	public $creditCardNumber;//string
	public $amount;//double
}

class CrmCreateCaseModel
{
	public $organizationName;//string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $amount;//double
	public $email;//string
	public $firstName;//string
	public $lastName;//string
	public $accountId;//Guid
	public $title;//string
	public $description;//string
	 
}

class CrmInterAccFundTransferRequestModel
{
	public $organizationName;
	public $ownerUserId;
	public $businessUnitName;

	//MonetaryTransactionRequestInfo
	public $amount;
	public $tradingPlatformAccountId;
	public $internalComment;

	//TransferBetweenTPAccountsRequest
	public $oppositeAccountId;
	public $typ;



}

class CrmGetMonetaryStatmentModel
{
	public $organizationName;//string
	public $ownerUserId;//Guid
	public $businessUnitName;//string
	public $accountId;//Guid
	
	 
}

//copy from proudleverate 

class TradingPlatformAccountInfo {
	public $AccountDisabledOnTradingPlatform; // boolean
	public $AccountDoesntExistOnTradingPlatform; // boolean
	public $BaseCurrency; // CurrencyInfo
	public $CreationDate; // dateTime
	public $ExpirationDate; // dateTime
	public $Id; // guid
	public $LastLoginTime; // dateTime
	public $Name; // string
	public $ParentAccountId; // guid
	public $Password; // string
	public $TradingPlatform; // TradingPlatformInfo
}

class CrmMonetaryTransactionModelRequestModel
    {
        public $organizationName;
        public $ownerUserId;
        public $businessUnitName;
        public $amount;
        public $tradingPlatformAccountId;
        public $internalComment;
        public $shouldAutoApprove;
}
class AccountInfo {
	public $AcceptTermsAndConditions; // boolean
	public $AccountType; // PickListInfo
	public $AdditionalAttributes; // ArrayOfDynamicAttributeInfo
	public $AdditionalInfo1; // string
	public $AdditionalInfo2; // string
	public $AdditionalInfo3; // string
	public $Address1; // string
	public $Address2; // string
	public $ApiTrading; // boolean
	public $ApproveReceiveCommercial; // boolean
	public $AverageTradeSize; // PickListInfo
	public $CfdTradingExperience; // PickListInfo
	public $City; // string
	public $ContentType; // string
	public $Country; // string
	public $CountryOfCitizenship; // string
	public $CurrenciesTradingExperience; // PickListInfo
	public $DateOfBirth; // dateTime
	public $DisabledTradingPlatformAccountExists; // boolean
	public $Email; // string
	public $EnvironmentInfo; // EnvironmentInfo
	public $EstimatedAnnualIncome; // int
	public $EstimatedNetWorth; // int
	public $FirstName; // string
	public $FuturesTradingExperience; // PickListInfo
	public $HasDemoExperience; // boolean
	public $HowDidYouHearAboutUs; // PickListInfo
	public $Id; // guid
	public $LastName; // string
	public $ManagedAccount; // boolean
	public $MarketingInfo; // MarketingInfo
	public $MobileNumber; // string
	public $NumberOfTimesTradedInPastYear; // PickListInfo
	public $Occupation; // string
	public $OptionsTradingExperience; // PickListInfo
	public $OwningBusinessUnit; // string
	public $Phone1AreaCode; // string
	public $Phone1CountryCode; // string
	public $Phone1Number; // string
	public $PhoneAreaCode; // string
	public $PhoneCountryCode; // string
	public $PhoneNumber; // string
	public $PlaceOfBirth; // string
	public $SecuritiesTradingExperience; // PickListInfo
	public $SendSMS; // boolean
	public $SocialSecurityNumber; // string
	public $State; // string
	public $SuppliedNecessaryDocuments; // boolean
	public $Title; // PickListInfo
	public $TradingPlatformAccounts; // ArrayOfTradingPlatformAccountInfo
	public $ZipCode; // string
}
class CrmGetAccountBalanceModel
{
	public $organizationName;
	public $ownerUserId;
	public $businessUnitName;
	public $tradingPlatformAccountName;

}
    ?>