@extends('layouts.app')

@section('content')

    <div id="main-container">
        <div class="r-list-container action-bar-margin bbs-screen">
            <div class="r-ent">
                <div class="meta">
                    <span>p 幣 : </span>                    
                    <span>{{$user->pcoin}}</span>
                </div>
                <form action="addTrans">
                <div class="meta m-list-container">
                    <span class="author">輸入 eth 地址 : </span>
                    <div class="search-bar">
                    <input class="query" type="text" name="address" value="" placeholder="XXXXX">
                    </div>                   
                </div>
                <div class="meta m-list-container">
                    <span class="author"> 輸入 P 幣 : </span>
                    <div class="search-bar">
                    <input class="query" type="text" name="pcoin" value="" placeholder="XXXXX">
                    </div>                   
                </div>

                <div class="btn-group meta b-list-container">
                    <input type="submit" class="btn" value="轉換 token">
                </div> 
                </form>               
            </div>
        </div>
        <div class="bbs-screen bbs-footer-message">本網站已依台灣網站內容分級規定處理。此區域為限制級，未滿十八歲者不得瀏覽。</div>
    </div>
@endsection
