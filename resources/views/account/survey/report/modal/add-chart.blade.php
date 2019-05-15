<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
        <div class="modal-content">
            <form id="add-chart-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Chart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title</label>
                        <input type="text" class="form-control" id="chart-title" name="title" required>
                    </div>
                    <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Chart Type</label>
                            <select name="chart" class="form-control" id="chart_type">
                                @foreach ($chart_type as $i => $c)
                                    <option value="{{$i}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Column</label>
                            <select name="column" class="form-control" id="form-column" required>
                                <option disabled selected>--</option>
                                @foreach ($form->column as $i => $c)
                                    <option value="{{$i}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div id="pilgan-to-select">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to dashboard</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(ev){
                $("#add-chart-form").submit(function(e){
                    e.preventDefault();
                    let data = $(this).serializeArray();
                    console.log(data);
                })

                $("#form-column").on('change',function(e){
                        let id = $(this).val();
                        console.log(id);
                        $("#pilgan-to-select").html(form.column[id].name);
                    });
            })
        </script>
    @endpush