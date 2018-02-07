@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <chat-notification :success="success" :error="error"></chat-notification>
                <div class="panel panel-default">
                    <div class="panel-heading">Chat</div>
                    <div class="panel-body">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                                @messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                       <chat-users
                               {{Auth::user()->hasRole('admin')? ':is-admin="true"' : '' }}
                               :user="{{ Auth::user() }}"
                       ></chat-users>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection