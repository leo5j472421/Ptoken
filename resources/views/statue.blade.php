@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are Fucking in!


                    <table id='getwallethistory_withdraw' class="table hover">
                        <thead>
                            <tr>
                                <th width="6%"></th>
                                <th width="6%">status</th>
                                <th width="10%">Ptoken</th>
                                <th>Eth</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center"></td>
                                <td class="center">Up</td>
                                <td class="center">999</td>
                                <td class="center">65485.5</td>
                                <td class="center">2018.5.22.15:12</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
