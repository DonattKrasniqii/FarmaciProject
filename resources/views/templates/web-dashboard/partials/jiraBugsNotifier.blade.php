<div class="tab-pane fade" id="jiraBugPanel" role="tabpanel">
    <div class="myaccount-content">
        <div class="account-details-form">
            <form action="{{action('JiraController@store')}}" id="blogForm"
                  method="post" autocomplete="off">
                @csrf
                <div class="account-info input-style mb-30">
                    <label>Titulli *</label>
                    <input type="summary" value=""  name="summary" required>
                    @error('summary')
                    <span>{{__('Mbush')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Përshkrimi</label>
                    <textarea name="description" cols="4" rows="5"
                              id="description"></textarea>
                    @error('description')
                    <span>{{__('Shkruaj Përshkrimin')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Tipi *</label>
                    <select name="issuetype" required>
                        <option value="" disabled>{{__('Tipi *')}}</option>
                            <option value="Improvement" >Improvement </option>
                            <option value="Task" >Task </option>
                            <option value="Bug" > Bug </option>
                            <option value="Epic" >Epic </option>
                    </select>
                    @error('issuetype')
                    <span>{{__('Zgjedh *')}}</span>
                    @enderror
                </div>
                <div class="account-info input-style mb-30">
                    <label>Prioriteti *</label>
                    <select name="priority" required>
                        <option value="" disabled>{{__('Prioriteti *')}}</option>
                        @foreach(getJiraPriorities() as $priority)
                            <option value="{{$priority}}"> {{$priority}}</option>
                        @endforeach

                    </select>
                    @error('issuetype')
                    <span>{{__('Zgjedh *')}}</span>
                    @enderror
                </div>
                <div class="account-info-btn">
                    <button type="submit">{{__('Dërgo ')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.css"
          integrity="sha512-xc6LLwdApLadqLJTZCrkXyYGYqJxk+pyhCCw4pQa4lSDxUHfW1Wn6Inh8bvGAxXsU6SsP4zOTR99nnU79E5Tig=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.6.11/jodit.min.js"
            integrity="sha512-v8HnXqzpxUsxGp5URUiLSIAeMzlVZtFsJRkmLav9kVmD8O6vdbyMhJGGFWGL76T6+NRZydBBEn46LivCl5Rxsg=="
            crossorigin="anonymous"></script>
    <script>
        function loadImage() {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }


        var filesInput = $("#other_photos");

        filesInput.on("change", function (e) {
            var files = e.target.files; //FileList object
            var result = $("#otherPhottosDivImgPlace");
            $('#otherPhottosDiv').removeClass('d-none');
            $('#otherPhottosDivImgPlace').html('');
            $.each(files, function (i, file) {
                var pReader = new FileReader();

                pReader.addEventListener("load", function (e) {
                    var pic = e.target;
                    result.append('<div class="single-sidebar-post">' + '<a href="javascript:void(0)">' +
                        "<img width='200px' src='" + pic.result + "'/>" +
                        '</a>' + '</div>');

                });
                pReader.readAsDataURL(file);

            });


        });

        $('#outputLink').click(function () {
            $('#main_photo').click();
        });
    </script>
    <script type="text/javascript">
        var editor = new Jodit('#description')
    </script>
@endsection

