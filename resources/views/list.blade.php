<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax ToDo List</title>
        
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<br>
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6" id="itemsList">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ajax ToDo List <a href="#" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a></h3>
                    </div>
                    <div class="panel-body" >
                        <ul class="list-group">
                            @foreach ($items as $item)
                                <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">{{$item->item}}
                                    <input type="hidden" id="itemId" value="{{$item->id}}">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="addNew" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Add New Item</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idOfSelectedItem">
                <p><input type="text" class="form-control" id="addItem" placeholder="Write here..."></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">Delete</button>
                <button type="button" class="btn btn-danger" id="saveChanges" data-dismiss="modal" style="display: none">Save changes</button>
                <button type="button" class="btn btn-primary" id="AddButton" data-dismiss="modal">Add Item</button>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{csrf_field()}}

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.ourItem', function(event){
                var text = $(this).text()
                var id = $(this).find("#itemId").val();
                $('#title').text('Edit Item');
                $('#addItem').val(text);
                $('#delete').show(400);
                $('#saveChanges').show(400);
                $('#AddButton').hide(400);
                $('#idOfSelectedItem').val(id);
                console.log(text, ' with id: ',id);
           });

           $(document).on('click', '#addNew', function(event){
                $('#title').text('Add New Item');
                $('#addItem').val("");
                $('#delete').hide(400);
                $('#saveChanges').hide(400);
                $('#AddButton').show(400);
                console.log('jquery works on Add New click');
           });
              
           $('#AddButton').click(function(event) {
                var text = $('#addItem').val();
                $.post('list', {'text': text, '_token': $('input[name=_token]').val()}, function(data) {
                    // return data from the controller on the backend side
                    console.log(data);
                    $('#itemsList').load(location.href + ' #itemsList');
                });                
           });

           $('#delete').click(function(event){
               var id = $('#idOfSelectedItem').val();
                $.post('delete', {'id': id, '_token': $('input[name=_token]').val()}, function(data) {
                    // return data from the controller on the backend side
                    $('#itemsList').load(location.href + ' #itemsList');
                    console.log(data);
                });  
           });
            
           $('#saveChanges').click(function(event){
               var id = $('#idOfSelectedItem').val();
               var newText = $('#addItem').val();
                $.post('update', {'id': id, 'newText': newText, '_token': $('input[name=_token]').val()}, function(data) {
                    // return data from the controller on the backend side
                    $('#itemsList').load(location.href + ' #itemsList');
                    console.log(data);                    
                });  
           });
        });
    </script>
</body>
</html>
