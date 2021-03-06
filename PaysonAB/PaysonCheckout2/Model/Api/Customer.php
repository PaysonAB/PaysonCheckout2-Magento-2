<?php
namespace PaysonAB\PaysonCheckout2\Model\Api;

class Customer
{
    /**
 * @var string $city 
*/
    public $city;
    /**
 * @var string $countryCode 
*/
    public $countryCode;
    /**
 * @var int $identityNumber Date of birth YYMMDD (digits). 
*/
    public $identityNumber;
    /**
 * @var string $email 
*/
    public $email;
    /**
 * @var string $firstName 
*/
    public $firstName;
    /**
 * @var string $lastName 
*/
    public $lastName;
    /**
 * @var string $phone Phone number. 
*/
    public $phone;
    /**
 * @var string $postalCode Postal code. 
*/
    public $postalCode;
    /**
 * @var string $street Street address.
*/
    public $street;
    /**
 * @var string $type Type of customer ("business", "person" (default)).
*/
    public $type;

    /*public function __construct()
    {

    }*/

    public function customerInit($firstName = null, $lastName = null, $email = null, $phone = null, $identityNumber = null, $city = null, $countryCode = null, $postalCode = null, $street = null, $type = 'person')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->identityNumber = $identityNumber;
        $this->city = $city;
        $this->countryCode = $countryCode;
        $this->postalCode = $postalCode;
        $this->street = $street;
        $this->type = $type;
        return $this;
    }
    
    public static function create($data)
    {
        $customerObject = new Customer();
        return $customerObject->customerInit($data->firstName, $data->lastName, $data->email, $data->phone, $data->identityNumber, $data->city, $data->countryCode, $data->postalCode, $data->street, $data->type);
    }
    
    public function toArray()
    {
        return get_object_vars($this);
    }
}
