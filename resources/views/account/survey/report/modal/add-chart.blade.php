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
                                    @if($c->isPilganable())
                                        <option value="{{$i}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                                
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Element Size</label>
                            <select name="size" class="form-control" id="form-column" required>
                                <option value="0">Small</option>
                                <option value="1">Medium</option>
                                <option value="2">Large</option>
                            </select>
                    </div>
                    <div id="pilgan-to-select" class="row">
                        
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
            function addChartElement(chart_id,title,column_id,size_index){
                let ts = Date.now();
                $("#report-container").append(`
                <div class="col-`+sizes[size_index]+` added-chart" id="chart-`+ts+`">
                            <input type="hidden" name="element[`+ts+`][type]" value="chart" />
                            <input type="hidden" name="element[`+ts+`][title]" value="`+title+`" />
                            <input type="hidden" name="element[`+ts+`][column]" value="`+form.column[column_id].id+`" />
                            <input type="hidden" name="element[`+ts+`][size]" value="`+sizes[size_index]+`" />
                            
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class="fa fa-poll"></i> <strong>`+chart_type[chart_id].name+`</strong> Chart</span>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                              </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    Title : `+title+`<br/>
                                    Column :  `+form.column[column_id].name+`<br/>
                                    Size : medium
                                </div>
                            </div>
                        </div>`);
            }
            $(document).ready(function(ev){
                $("#add-chart-form").submit(function(e){
                    e.preventDefault();
                    let data = {};
                    $(this).serializeArray().forEach(element => {
                        data[element.name] = element.value;
                    });
                    addChartElement(data.chart,data.title,data.column,data.size);
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