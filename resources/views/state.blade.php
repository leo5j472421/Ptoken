@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="r-list-container action-bar-margin bbs-screen">
        <div class="r-ent">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <table id='getwallethistory_withdraw' class="table hover">
                    <thead>
                        <tr>
                            <th width="6%">status</th>
                            <th width="10%">Ptoken</th>
                            <th>Eth</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">Up</td>
                            <td class="">999</td>
                            <td class="">65485.5</td>
                            <td class="">2018.5.22.15:12</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="bbs-screen bbs-footer-message"> 本網站已依台灣網站內容分級規定處理。此區域為限制級，未滿十八歲者不得瀏覽。
    </div>    
</div>
@endsection
