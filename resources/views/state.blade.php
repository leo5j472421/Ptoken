@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="r-list-container action-bar-margin bbs-screen">
        @foreach ($transcations as $tran)
        <div class="r-ent">
            <div class="title">
             

                <span>[ {{$tran['state']}} ] {{$tran['eth']}}</span>
            </div>
            {{$tran['address']}}
            <div class="meta">
                <div class="author">{{$tran['ptoken']}}</div>
                <div class="date"> {{$tran['created_at']}}</div>
            </div>
        </div>   
        @endforeach

         
    </div>
    <div class="bbs-screen bbs-footer-message"> 本網站已依台灣網站內容分級規定處理。此區域為限制級，未滿十八歲者不得瀏覽。
    </div>    
</div>
@endsection
