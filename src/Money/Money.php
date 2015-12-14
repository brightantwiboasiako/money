<?php namespace Money;
use Money\Exceptions\InvalidAmountException;

/**
 * Description of Money
 *
 * @author Bright Antwi Boasiako<brightantwiboasiako@aol.com>
 */
class Money 
{
    
    /**
     * private int $amount
     * 
     * The whole part of the money
     * 
     * @var int
     * 
     * @access private
     */
    private $whole = 0;


    /**
     * private int fraction
     *
     * The fractional part of the money
     *
     * @var int
     *
     * @access private
     */
    private $fraction = 0;
    
    
    /**
     * private Money\Currency $currency
     * 
     * The currency of the money
     * 
     * @var Currency
     * 
     * @access private
     */
    private $currency;
    
    
    /**
     * public Money\Money(\Money\Currency $currency)
     * 
     * Instantiates the currency object
     * 
     * @param \Money\Currency $currency
     */
    public function __construct($amount, Currency $currency = null)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }
    
    
    /**
     * private void setAmount(double $amount)
     * 
     * Sets the amount of the money
     * 
     * @param double $amount
     * 
     * @return void
     */
    private function setAmount($amount)
    {
        $this->setWhole($amount);
        $this->setFraction($amount);
    }


    /**
     * Sets the whole number part of the money
     *
     * @param $amount
     * @return void
     */
    private function setWhole($amount)
    {
        $this->whole = (int)floor($amount);
    }


    /**
     * Sets the fractional part of the money
     *
     * @param $amount
     * @return void
     */
    private function setFraction($amount)
    {
        $this->fraction = (int)floor(($amount - $this->getWhole()) * 100);
    }


    public function add(Money $money)
    {
        $sum = new Money($this->getAmount() + $money->getAmount());

        $this->setWhole($sum->getWhole());
        $this->setFraction($sum->getFraction());
    }


    /**
     * @param Money $money
     * @throws InvalidAmountException
     */
    public function subtract(Money $money)
    {
        if($this->notLessThan($money))
        {
            $diff = new Money($this->getAmount() - $money->getAmount());

            $this->setWhole($diff->getWhole());
            $this->setFraction($diff->getFraction());
        }
        else
            throw new InvalidAmountException;
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function lessThan(Money $money)
    {
        return $this->getAmount() < $money->getAmount();
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function greaterThan(Money $money)
    {
        return $this->getAmount() > $money->getAmount();
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function notLessThan(Money $money)
    {
        return $this->getAmount() >= $money->getAmount();
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function netGreaterThan(Money $money)
    {
        return $this->getAmount() <= $money->getAmount();
    }


    public function equals(Money $money)
    {
        return $this->getWhole() == $money->getWhole()
               && $this->getFraction() == $money->getFraction();
    }

    
    /**
     * public double getAmount(void)
     * 
     * Gets the amount of the money
     * 
     * 
     * @return double
     */
    public function getAmount()
    {
        return (double)($this->getWhole().'.'.$this->getFraction());
    }
    
    
    /**
     * public int getWhole(void)
     * 
     * Gets the whole number part of the money
     * 
     * @return int
     */
    public function getWhole()
    {
        return $this->whole;
    }
    
    
    /**
     * public int getFraction(void)
     * 
     * Gets the fraction part of the money
     * 
     * @return int
     */
    public function getFraction()
    {
        return $this->fraction;
    }
    
    
    /**
     * private void setCurrency(\Money\Currency $currency)
     * 
     * Sets the currency of the money
     * 
     * @param \Money\Currency $currency
     * 
     * @return void
     */
    private function setCurrency(Currency $currency = null)
    {
        if($currency != null)
            $this->currency = $currency;
        else
        {
            $this->currency = new Currency();
        }
    }
    
    /**
     * private \Money\Currency getCurrency(void)
     * 
     * Gets the currency of the money
     * 
     * 
     * @return \Money\Currency
     */
    private function getCurrency()
    {
        return $this->currency;
    }
    
    
    /**
     * public String __toString(void)
     * 
     * Gets the string representation of the money
     * 
     * @return String
     */
    public function __toString()
    {
        return $this->getCurrency()->format($this->getAmount());
    }
    
}
