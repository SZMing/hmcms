<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/30/17
 * Time: 8:21 AM
 */

namespace Module\Web\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Web\Src\Model\Interfaces\NewsInterface;

class NewsController extends Controller
{
    public function __construct(NewsInterface $news)
    {
        $this->news_model = $news;
        $this->request = new Request();
    }

    /**
     * 新闻页面
     */
    public function news()
    {
        $offset = $this->request->get('offset');
        $many = $this->request->get('many');
        $offset = isset($offset) ? $offset : 1;
        $many = isset($many) ? $many : 10;

        // 总数$result['count'] 结果集$result['result']
        $result = $this->news_model::news($offset,$many);

        //计算页数
        $pagecount = ceil((int)$result['count']['count']/(int)$many);
        $result['pagecount'] = $pagecount;
        $result['offset'] = $offset;
        $result['many'] = $many;

        return $this->render('web/news/news',['result' => $result]);
    }
}