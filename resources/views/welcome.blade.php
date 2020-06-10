@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border border-0 ">
                <div class="card-header">Envoyer une demande</div>

                <div class="card-body ">
                        <form id="target"  >
                            <meta name="_token" content="{{ csrf_token() }}">
                            <div class="form-group">    
                                <label for="sujet">Sujet:</label>
                                <input type="text" class="form-control" id="sujet"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" cols="30" rows="4" id="description"></textarea>
                                <div class="mt-1 mb-5">
                                    <p class="float-right" id="nmbrtext"></p>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-dark mr-2">envoyer</button>
                                <button type="button" id="annuler" class="btn btn-light border border-1">annuler</button>
                            </div>
                        </form>  

                        <div class="messages">
                                <div id="msg-success" class="alert alert-success alert-dismissible" style="display:none">
                                    <strong>Le message a été bien envoyé, merci</strong>
                                </div>
                                <div id="msg-errors" class="alert alert-danger" style="display:none">
                                    <strong id="msg-errors-text"></strong>
                                </div>
                        </div>

                </div>
                
            </div>
        </div>
    </div>
    <script >
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    statusCode: {
                        500: function() {
                        alert("Script exhausted");
                        }
                    }
                });


                $( "#target" ).submit(function( event ) {
                        $.ajax({
                        url:"api/store",
                        type:'post',
                        data:{"email":$( "#email" ).val(),"sujet":$( "#sujet" ).val(),"description":$( "#description" ).val()},
                        success:function(data){
                            if (data.success) {
                                $( "#msg-success" ).show();
                                $( "#msg-errors" ).hide();
                                $( "#msg-success-text" ).text(data.success);
                                $( "#email" ).val("") ;
                                $( "#sujet" ).val("") ;
                                $( "#description" ).val("") ;
                            }
                            if (data.errors) {
                                $( "#msg-errors" ).show();
                                if (data.errors.sujet) {
                                    $( "#msg-errors-text" ).text( data.errors.sujet[0] );
                                }          
                                if (data.errors.email) {
                                    $( "#msg-errors-text" ).text( data.errors.email[0] );
                                } 
                                if (data.errors.description) {
                                    $( "#msg-errors-text" ).text( data.errors.description[0] );
                                }            
                            }          
                            
                        },

                        error: function (data) {
                            $( "#msg-errors" ).show();
                            $( "#msg-success" ).hide();
                            $( "#msg-errors-text" ).text( "La connexion n'a pas pu être établie avec le serveur" );
                            
                            if (data.responseJSON) {
                                if (data.responseJSON.message) {
                                    $( "#msg-errors-text" ).text(data.responseJSON.message);
                                }
                            }
                        },
                        statusCode: {
                            500: function() {
                                $( "#msg-errors" ).show();
                                $( "#msg-success" ).hide();
                                $( "#msg-errors-text" ).text( "La connexion n'a pas pu être établie avec le serveur" );
                            }
                        },
                    });
                    event.preventDefault();
                });


                $( "#annuler" ).click(function(){ 
                    $( "#email" ).val("") ;
                    $( "#sujet" ).val("") ;
                    $( "#description" ).val("") ;
                    $( "#msg-success" ).hide();
                    $( "#msg-errors" ).hide();
                    return;  
                });  

                $('textarea').keyup(function() {
                    var length = $(this).val().length;
                    if (length>=200) {
                        $("#nmbrtext").css("color", "red");  
                    }else{
                        $("#nmbrtext").css("color", "black");  
                    }
                    $('#nmbrtext').text(length+"/200");
                });

    </script>
    
</div>

@endsection

