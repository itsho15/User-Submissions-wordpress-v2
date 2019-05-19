<?php


use Hotfix\Datatables\Datatables;
use Hotfix\Datatables\Request;

class DatatablesTest extends PHPUnit_Framework_TestCase
{
    public function test_get_html_builder()
    {
        $datatables = $this->getDatatables();
        $html       = $datatables->getHtmlBuilder();

        $this->assertInstanceOf('Hotfix\Datatables\Html\Builder', $html);
    }

    public function test_get_request()
    {
        $datatables = $this->getDatatables();
        $request    = $datatables->getRequest();

        $this->assertInstanceOf('Hotfix\Datatables\Request', $request);
    }

    /**
     * @return \Hotfix\Datatables\Datatables
     */
    protected function getDatatables()
    {
        $datatables = new Datatables(Request::capture());

        return $datatables;
    }
}
