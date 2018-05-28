@extends('layouts.app')

@section('content')

    <div id="main-container">
        <div id="action-bar-container">
            <div class="action-bar">
                <div class="btn-group btn-group-dir">
                    <a class="btn selected" href="/">申請</a>
                    <a class="btn" href="/state">狀態</a>
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
            
            @if (!$user->address)
            <div class="r-ent">
                <div class="meta">
                    <span>P 幣 : </span>                    
                    <span>{{$user->pcoin}}</span>
                </div>
                <form action="bindAddress" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="meta m-list-container">
                    <span class="author">錢包地址 : </span>
                    <div class="search-bar">
                    <input class="query" type="text" name="address" value="" placeholder="XXXXX">
                    </div>                   
                </div>

                <div class="btn-group meta b-list-container">
                    <input type="submit" class="btn" value="綁定錢包" style="margin-left: 2.5ex;">
                </div> 
                </form>               
            </div>
            @else
            <div class="r-ent">
                <div class="meta">
                    <span>P 幣 : </span>                    
                    <span>{{$user->pcoin}}</span>
                </div>
                <form action="addTrans" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="meta m-list-container">
                    <span class="author">錢包地址 : {{ $user->address }}</span>             
                </div>
                <div class="meta m-list-container">
                    <span class="author">P 幣數量 : </span>
                    <div class="search-bar">
                    <input class="query" type="text" name="pcoin" v-model="ptoken">
                    </div>                   
                </div>
                <div class="meta m-list-container">
                    <span class="author">兌換數量 : @{{ ptoken }}</span>             
                </div>

                <div class="btn-group meta b-list-container">
                    <input type="submit" class="btn" value="轉換 token" style="margin-left: 2.5ex;">
                </div> 
                </form>               
            </div>
            @endif
        </div>
        <div class="bbs-screen bbs-footer-message">本網站已依台灣網站內容分級規定處理。此區域為限制級，未滿十八歲者不得瀏覽。</div>
    </div>
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                ptoken: "1:1000"
            }
        }
    });    
</script>
@endsection