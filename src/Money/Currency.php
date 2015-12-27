<?php namespace Money;

/**
 * Description of Currency
 *
 * @author Bright Antwi Boasiako<brightantwiboasiako@aol.com>
 */
class Currency 
{
    
    /**
     *  The Locale of the currency
     * 
     * @var Locale $locale
     * 
     * @access private 
     */
    private $locale;
    
    
    /**
     *  The number formatter of the currency
     * 
     * @var \NumberFormatter $numberFormatter
     * 
     * @access private 
     */
    private $numberFormatter;
    
    
    const CURRENCY_DEFAULT_LOCALE = 'ak-GH';
    
    
    /**
     * public \Money\Currency $locale
     * 
     * Constructs a new currency
     * 
     * @param String $locale
     */
    public function __construct($locale = null)
    {
        $this->setLocale($locale);
        $this->setNumberFormatter($this->getLocale());
    }
    
    
    /**
     * private void setNumberFormatter(String $locale)
     * 
     * Sets the number formatter of the currency
     * 
     * @param String $locale
     * 
     * @return void
     */
    private function setNumberFormatter($locale)
    {
        $this->numberFormatter = new \NumberFormatter($locale, 
        \NumberFormatter::CURRENCY);
    }
    
    
    /**
     * private void setLocale(String $locale)
     * 
     * Sets the locale of the currency
     * 
     * @param String $locale
     * 
     * @return void
     */
    private function setLocale($locale)
    {
        if($locale != null)
        {
            \Locale::setDefault($locale);
        }
        else 
        {
           \Locale::setDefault(self::CURRENCY_DEFAULT_LOCALE); 
        }
        
        $this->locale = \Locale::getDefault();
    }
    
    
    /**
     * public String getLocale(void)
     * 
     * Gets the locale of the currency
     * 
     * @return String
     */
    public function getLocale()
    {
        return $this->locale;
    }
    
    
    /**
     * private \NumberFormatter getNumberFormatter(void)
     * 
     * Gets the number formatter for this currency 
     * instance
     * 
     * @return \NumberFormatter
     */
    private function getNumberFormatter()
    {
        return $this->numberFormatter;
    }
    
    /**
     * public String getSymbol()
     * 
     * Gets the symbol of the currency
     * 
     * @return String
     */
    public static function getSymbol()
    {
        $currency = new static();
        return $currency->getNumberFormatter()
                ->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
    
    
    public function format($amount)
    {
        return $this->getNumberFormatter()->format($amount);
    }
    
}
