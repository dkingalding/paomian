@extends('layouts.app')
@section('title', '商品列表')

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body">

                            <!-- 筛选组件开始 -->
                            <form action="{{ route('products.index') }}" class="search-form">
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-row">
                                            <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
                                            <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="order" class="form-control form-control-sm float-right">
                                            <option value="">排序方式</option>
                                            <option value="price_asc">价格从低到高</option>
                                            <option value="price_desc">价格从高到低</option>
                                            <option value="sold_count_desc">销量从高到低</option>
                                            <option value="sold_count_asc">销量从低到高</option>
                                            <option value="rating_desc">评价从高到低</option>
                                            <option value="rating_asc">评价从低到高</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                    <div class="row products-list">
                        @foreach($products as $product)
                            <div class="col-3 product-item">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img"><img src="http://m.360buyimg.com/n1/{{ $product->primaryPic }}"  alt=""></div>
                                        <div class="price"><b>&le;￥</b>77 </div>
                                        <div class="title">{{ $product->shortProductName }}</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">新旧程度 <span>{{ $product->quality  }}</span></div>
                                        <div class="review_count">可拍卖数 <span>55</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">{{ $products->render() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
