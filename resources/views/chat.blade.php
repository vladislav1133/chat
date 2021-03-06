@extends('layouts.app')

@section('content')
    <div id="chat">
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
                                    @message-sent="addMessage"
                                    :user="user"
                            ></chat-form>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Users</div>

                        <div class="panel-body">
                            <chat-users
                                    @ban-user="manageUser"
                                    @mute-user="manageUser"
                                    :user="user"
                            ></chat-users>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection