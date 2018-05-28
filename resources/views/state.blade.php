@extends('layouts.app')

@section('content')
<div class="main-container">
    <div id="action-bar-container">
        <div class="action-bar">
            <div class="btn-group btn-group-dir">
                <a class="btn" href="/">申請</a>
                <a class="btn selected" href="/state">狀態</a>
            </div>
        </div>
    </div>
    <div class="r-list-container action-bar-margin bbs-screen">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @foreach ($transcations as $tran)
        <div class="r-ent">
            <div class="title">
                <span>[ {{$tran['state']}} ]</span>
                <span>P幣 :</span>
                <span>{{$tran['pcoin']}}</span>
            </div>
            
            <div class="meta">
                <div class="author"> ptoken:{{$tran['token']}}  addr:{{$tran['address']}}</div>
                <div class="date"> {{$tran['created_at']}}</div>
            </div>
        </div>   
        @endforeach

         
    </div>
    <div class="bbs-screen bbs-footer-message"> 本網站已依台灣網站內容分級規定處理。此區域為限制級，未滿十八歲者不得瀏覽。
    </div>    
</div>
@endsection
