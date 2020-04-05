<?php
namespace App\Admin\Controllers;

use App\Models\Product;
use App\Admin\Actions\usedNo\offer;
use App\Admin\Actions\usedNo\status;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class usedNameController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
//    protected $title = 'App\usedName';
    protected $usedno;
    protected $title = 'App\Models\Product';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        // var_dump($grid);
        // $grid->model()->withCount('goods');

        $grid->model()->orderBy('productName');
        // $grid->model()->orderBy('vagePric');
        $grid->column('usedNo', __('usedNo'));
        $grid->column('productName', __('productName'));
        $grid->column('primaryPic', '图片')->image('http://m.360buyimg.com/n1', 100, 100);
        $grid->column('quality', __('新旧'));
        // $grid->column('shopName.shopName', __('shopName'));
        $grid->column('shopId', '商家')->display(function ($shopId) {
            // return $shopId;
            if ($shopId == 0) {
                return "京东";
            } else {
                return "其他";
            }
        });
        $grid->column('goods', '可拍数')->display(function ($goods) {
            $bb = count($goods);
            if ($bb) {
                return "<span class='label label-warning'>" . $bb . "</span>";
            }

        });
        $grid->column('theprice.vagePrice', __('平均价格'))->display(function ($vagePrice) {

            return "<span class='label label-success'>" . $vagePrice . "</span>";
        });
        $grid->column('theprice.price', __('最后价格'));
        $grid->column('theprice.notes', __('最近数量'));
        // $grid->disableExport();
        $grid->disableCreateButton();
        // $grid->model()->where('shopId', '=', 0);

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();


            $filter->like('productName', '商品名');
            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'no':
                        $query->where('shopId', 0);
                        break;
                    case 'yes':

                        break;
                }
            }, '货源', 'shopId')->radio([
                'no' => '京东备件库',
                'yes' => '所有商品',

            ]);
            $filter->where(function ($query) {
                switch ($this->input) {
                    case '7新':
                        $query->where('quality', '7成新');
                        break;
                    case '8新':
                        $query->where('quality', '8成新');
                        break;
                    case '9新':
                        $query->where('quality', '9成新');
                        break;
                    case '95新':
                        $query->where('quality', '95成新');
                        break;
                    case '准新品':
                        $query->where('quality', '准新品');
                        break;
                    default:

                        break;
                }
            }, '新旧', 'quality')->radio([
                '7新' => '7新',
                '8新' => '8新',
                '9新' => '9新',
                '95新' => '95新',
                '准新品' => '准新品',
                '全部' => '全部'

            ]);


        });
        $grid->actions(function ($actions) {

            $actions->disableDelete();

            // // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
            $actions->add(new offer());
            $actions->add(new status);

        });
        // 去掉批量操作
        $grid->disableBatchActions();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    // protected function detail($id)
    // {
    //     $show = new Show(usedName::findOrFail($id));


    //     return $show;
    // }

    public function show($id, Content $content)
    {
        // print_r(time()*1000);
        $uuu = $id;
        return $content->header('商品')
            ->description('详情')
            ->body(Admin::show(usedName::findOrFail($id), function (Show $show) {

                $show->productName('ID');
                $show->goods('可拍卖', function ($goods) {
                    $UU = time() * 1000;
                    $goods->resource('/admin/goods');
                    $goods->model()->where('endTime', '>', $UU);
                    $goods->id();
                    // $goods->content()->limit(10);
                    // $goods->endTime();
                    $goods->endTime()->display(function ($endTime) {
                        $endTime = $endTime / 1000;
                        // return $endTime;
                        return date("Y-m-d h:i:sa", $endTime);
                    });
                    // $goods->updated_at();
                    $goods->disableExport();

                    $goods->disableCreateButton();
                    $goods->actions(function ($actions) {

                        // 去掉删除
                        $actions->disableDelete();

                        // // 去掉编辑
                        $actions->disableEdit();

                        // 去掉查看
                        $actions->disableView();
                        //添加订单

                    });
                    $goods->filter(function ($filter) {
                        // $filter->gt('endTime', );
                        $filter->disableIdFilter();

                    });
                    $goods->disableBatchActions();
                });
                $show->panel()
                    ->tools(function ($tools) {
                        $tools->disableEdit();
                        $tools->disableList();
                        $tools->disableDelete();

                    });

            }));
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    // protected function form()
    // {
    //     $form = new Form(new usedName);

    //     $form->display('id', 'ID');


    //     return $form;
    // }
    public function addoffer($id, content $content)
    {
        return $content
            ->header("添加订单")
            ->body(goods::form_edit()->edit($id));
    }

}
