{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Contacts View')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
@endsection

{{-- page content  --}}
@section('content')
<!-- users view start -->
<div class="section users-view">
    <!-- users view media object start -->
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m7">
                <div class="display-flex media">
                    <a href="#" class="avatar">
                        <img src="{{ isset($contact->image) ? $contact->image->url():asset('/images/avatar/default.png') }}"
                            alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $contact->fullname }}</span>
                            <span class="grey-text"></span>
                            <span class="users-view-username grey-text">{{ $contact->job_title }}</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">{{ $contact->id }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                @if ($contact->type == 0)
                <a href="{{ route('convert.lead', $contact->id) }}" class="btn-small btn-light-indigo">Convert to Lead</a>
                @else
                <a href="" class="btn-small btn-indigo">Already a Lead</a>
                @endif
                <a href="{{ route('edit.contact', $contact->id) }}" class="btn-small indigo">Edit</a>
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Added:</td>
                                <td>{{ $contact->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Latest Edit:</td>
                                <td class="users-view-latest-activity">{{ $contact->updated_at }}</td>
                            </tr>
                            <tr>
                                <td>Agent:</td>
                                <td class="users-view-role">
                                    {{ $contact->user->fullname() }}</td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td class="users-view-role">
                                    @if ($contact->type === 0)
                                    Contact
                                    @elseif ($contact->type === 1)
                                    Lead
                                    @elseif ($contact->type === 2)
                                    Customer
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Country:</td>
                                <td>{{ $country }}</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>{{ $city }}</td>
                            </tr>
                            <tr>
                                <td>District:</td>
                                <td>{{ $district }}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>{{ $contact->address }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- users view card data ends -->

    <!-- users view card details start -->
    <div class="card">
        <div class="card-content">
            {{-- <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Posts: <span>125</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Followers: <span>534</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Following: <span>256</span></h6>
        </div>
      </div> --}}
            <div class="row">
                <div class="col s12">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td class="users-view-username">{{ $contact->fullname }}</td>
                            </tr>
                            <tr>
                                <td>Job title:</td>
                                <td class="users-view-name">{{ $contact->job_title }}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="users-view-email">{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{ $contact->phone }}</td>
                            </tr>
                            <tr>
                                <td>Birthday:</td>
                                <td>{{ $contact->date_birth }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Twitter:</td>
                                <td><a href="{{ $contact->twitter }}">{{ $contact->twitter }}</a></td>
                            </tr>
                            <tr>
                                <td>Facebook:</td>
                                <td><a href="{{ $contact->facebook }}">{{ $contact->facebook }}</a></td>
                            </tr>
                            <tr>
                                <td>Skype:</td>
                                <td><a href="#">{{ $contact->skype }}</a></td>
                            </tr>
                            <tr>
                                <td>Linkedin:</td>
                                <td><a href="{{ $contact->linkedin }}">{{ $contact->linkedin }}</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- users view card details ends -->

</div>
<!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
{{-- <script src="{{asset('/js/scripts/page-users.js')}}"></script> --}}
@endsection