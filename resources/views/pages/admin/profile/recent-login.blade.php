@extends('layouts.admin-dashboard')

@section('content')
    <section class="app-user-view-security">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                @include('pages.admin.profile.includes.user-card')
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                @include('pages.admin.profile.includes.head')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Logins</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="text-start">IP</th>
                                <th>Logged Time</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adminLoginLogs as $admin)
                                <tr>
                                    <td class="text-start">
                                        <span class="fw-bolder">{{ $admin->remote_address }}</span>
                                    </td>
                                    <td>{{DateHelper::format($admin->logged_at, DateHelper::DEFAULT_DATE_TIME_FORMAT) }}</td>
                                    <td>{!! AuthMessages::getLoginStatus($admin->status) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
