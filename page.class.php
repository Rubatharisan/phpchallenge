<?php
class page{
	public $pageTitle;
	public $pageHeader;
	public $pageText;

    /**
     * Gets the value of pageTitle.
     *
     * @return mixed
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Sets the value of pageTitle.
     *
     * @param mixed $pageTitle the page title
     *
     * @return self
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Gets the value of pageHeader.
     *
     * @return mixed
     */
    public function getPageHeader()
    {
        return $this->pageHeader;
    }

    /**
     * Sets the value of pageHeader.
     *
     * @param mixed $pageHeader the page header
     *
     * @return self
     */
    public function setPageHeader($pageHeader)
    {
        $this->pageHeader = $pageHeader;

        return $this;
    }

    /**
     * Gets the value of pageText.
     *
     * @return mixed
     */
    public function getPageText()
    {
        return $this->pageText;
    }

    /**
     * Sets the value of pageText.
     *
     * @param mixed $pageText the page text
     *
     * @return self
     */
    public function setPageText($pageText)
    {
        $this->pageText = $pageText;

        return $this;
    }
}
?>