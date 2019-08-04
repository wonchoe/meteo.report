@extends('admin.layouts.app')

@section('title', 'Code Editor')

@section('src_top')
        <link rel='stylesheet' href="{{ asset('css/codeeditor.css') }}">
        <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/codemirror.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/lint/lint.css">
        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/codemirror.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/lint/lint.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/lint/javascript-lint.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/lint/json-lint.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/lint/css-lint.js"></script>
        <script src="https://unpkg.com/jshint@2.9.6/dist/jshint.js"></script>
        <script src="https://unpkg.com/jsonlint@1.6.3/web/jsonlint.js"></script>
        <script src="https://unpkg.com/csslint@1.0.5/dist/csslint.js"></script> 
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


@endsection

@section('content')


<!-- Modal -->
  <div class="modal fade" id="modalWin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div id="modalContent"><p>...</p></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item w-100">
        <div class="row gap-20">
            <div class="col-md-3">
                <div class="layers bd bgc-white p-20">
                    <div class="layer w-100 mB-10"><h6 class="lh-1">Total Visits</h6></div>
                    <div class="layer w-100">
                        <div class="peers ai-sb fxw-nw">
                            <div class="peer peer-greed"><span id="sparklinedash"></span></div>
                            <div class="peer"><span
                                    class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">+10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="layers bd bgc-white p-20">
                    <div class="layer w-100 mB-10"><h6 class="lh-1">Total Page Views</h6></div>
                    <div class="layer w-100">
                        <div class="peers ai-sb fxw-nw">
                            <div class="peer peer-greed"><span id="sparklinedash2"></span></div>
                            <div class="peer"><span
                                    class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="layers bd bgc-white p-20">
                    <div class="layer w-100 mB-10"><h6 class="lh-1">Unique Visitor</h6></div>
                    <div class="layer w-100">
                        <div class="peers ai-sb fxw-nw">
                            <div class="peer peer-greed"><span id="sparklinedash3"></span></div>
                            <div class="peer"><span
                                    class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">~12%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="layers bd bgc-white p-20">
                    <div class="layer w-100 mB-10"><h6 class="lh-1">Bounce Rate</h6></div>
                    <div class="layer w-100">
                        <div class="peers ai-sb fxw-nw">
                            <div class="peer peer-greed"><span id="sparklinedash4"></span></div>
                            <div class="peer"><span
                                    class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>



<div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item w-100">
        <div class="row gap-20"> </div>
        <div class="table-agile-info">
            <form>
                <textarea id="codeEditor" name="codeEditor" style="display: none;"></textarea>                          
            </form>                         
            <div class="container-full">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" id="saveButton" class="btn btn-primary btnMargin" style="visibility: hidden;">Save code</button>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</div>

@endsection

@section('src_bottom')
<script src="{{ asset('js/codeeditor.js')}}"></script> 
@endsection