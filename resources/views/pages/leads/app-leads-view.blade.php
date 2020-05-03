{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Leads View')

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
                        <img src="{{ isset($lead->image) ? $lead->image->url():asset('/images/avatar/default.png') }}"
                            alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $lead->fullname }}</span>
                            <span class="grey-text"></span>
                            <span class="users-view-username grey-text">{{ $lead->job_title }}</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">{{ $lead->id }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                <form id="delete_lead" action="{{ route('delete.lead', $lead->id) }}" method="post">
                    @csrf
                <a class="btn-small btn-light-red" onclick="$('#delete_lead').submit()"><i
                        class="material-icons">delete</i></a></form>
                <a href="{{ route('edit.lead', $lead->id) }}" class="btn-small indigo">Edit</a>
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contact_phone</i> Lead Details</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Lead Title:</td>
                                <td>{{ $lead->lead_title }}</td>
                            </tr>
                            <tr>
                                <td>Lead Source:</td>
                                <td class="users-view-latest-activity">{{ $lead->lead_source }}</td>
                            </tr>
                            <tr>
                                <td>Due date:</td>
                                <td class="users-view-role">
                                    {{ Carbon\Carbon::make($lead->lead_date)->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <td>Value:</td>
                                <td class="users-view-role">
                                    {{ $lead->lead_value }}
                                </td>
                            </tr>
                            <tr>
                                <td>Lead Stage:</td>
                                <td class="users-view-role">
                                    {{ $stage->title }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contacts</i> Contact Details</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td class="users-view-username">{{ $lead->fullname }}</td>
                            </tr>
                            <tr>
                                <td>Job title:</td>
                                <td class="users-view-name">{{ $lead->job_title }}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="users-view-email">{{ $lead->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{ $lead->phone }}</td>
                            </tr>
                            <tr>
                                <td>Birthday:</td>
                                <td>{{ $lead->date_birth }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Added:</td>
                                <td>{{ $lead->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Latest Edit:</td>
                                <td class="users-view-latest-activity">{{ $lead->updated_at }}</td>
                            </tr>
                            <tr>
                                <td>Agent:</td>
                                <td class="users-view-role">
                                    {{ $lead->user->fullname() }}</td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td class="users-view-role">
                                    @if ($lead->type === 0)
                                    Contact
                                    @elseif ($lead->type === 1)
                                    Lead
                                    @elseif ($lead->type === 2)
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
                                <td>{{ $lead->address }}</td>
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
            <div class="row">
                <div class="col s6">
                    <table class="striped">

                    </table>
                    <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Twitter:</td>
                                <td><a href="{{ $lead->twitter }}">{{ $lead->twitter }}</a></td>
                            </tr>
                            <tr>
                                <td>Facebook:</td>
                                <td><a href="{{ $lead->facebook }}">{{ $lead->facebook }}</a></td>
                            </tr>
                            <tr>
                                <td>Skype:</td>
                                <td><a href="#">{{ $lead->skype }}</a></td>
                            </tr>
                            <tr>
                                <td>Linkedin:</td>
                                <td><a href="{{ $lead->linkedin }}">{{ $lead->linkedin }}</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">comment</i> Add a Comment</h6>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <form class="col s12"
                                    action="{{ route('store.leadcomment', ['lead'=>$lead, 'user'=>Auth::user()->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" class="materialize-textarea" name="message"
                                                placeholder="Your Comment.."></textarea>
                                            <button type="submit"
                                                class="waves-effect waves-light indigo btn">submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- users view card details ends -->
    {{-- comments section --}}
    <div class="card">
        <div class="card-content">
            <h6 class="mb-2 mt-2"><i class="material-icons">comment</i> Comments</h6>
            <div class="row">
                @foreach ($lead->comments->sortKeysDesc() as $comment)
                <div class="col s12">
                    <div class="card blue lighten-5">
                        <div class="card-content">
                            <span class="card-title"><img
                                    src="{{ isset($lead->image) ? $lead->image->url():asset('/images/avatar/default.png') }}"
                                    alt="users view avatar" class="z-depth-4 circle" height="32" width="32"><span
                                    class="red-text"> {{ $comment->user->fullname() }}</span></span>
                            <hr>
                            <p style="text-indent: 20px">{{ $comment->message }}</p>
                            <br>
                            <small><i class="material-icons">access_time</i>
                                {{ Carbon\Carbon::make($comment->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
{{-- <script src="{{asset('/js/scripts/page-users.js')}}"></script> --}}
@endsection