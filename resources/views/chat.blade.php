@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table>
                
                    @foreach($users as $user)
                        <tr><td>{{ $user->name }}</td></tr>
                    @endforeach

                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Chats</div>

                        <div class="panel-body">
                            <chat-messages :messages="messages"></chat-messages>
                        </div>
                        <div class="panel-footer">
                            <chat-form
                                v-on:messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                            ></chat-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
