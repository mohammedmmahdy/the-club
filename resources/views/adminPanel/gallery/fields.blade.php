<div id="product-photos">

    <div id="wrapper">
        <h2>Drop your Files</h2>
        <span>or</span>
        <br />
        <label for="file-upload">Choose Manually</label>
        <input type="file" name="photos[]" id="file-upload" multiple>
        <br />
        <div id="file-count"></div>
        <div id="file-preview">
            @if (isset($academy->photos))
            @foreach ($academy->photos as $photo)
            <a href="{{route('adminPanel.academies.destroyPhoto', $photo->id)}}" onclick="return confirm('Delete this Photo ?')">
                <i class="delete-btn fa fa-trash fa-3x text-danger"></i>
                <img src="{{$photo->photo_original_path}}" alt="" data-file={{$photo->id}}>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</div>
<div class="clearfix"></div>
<br>
<hr>
<br>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.contacts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>



@section('styles')
<style>
    button {
        background: green;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 20px;
        margin-top: 15px;
    }

    button:hover {
        cursor: pointer;
        background: darkgreen;
    }

    #product-photos #wrapper {
        /* width: 450px;
        height: 400px; */
        padding: 5rem;
        background: #f1f1f1;
        display: flex;
        justify-content: center;
        flex-direction: column;
        border-radius: 20px;
        text-align: center;
        position: relative;
    }

    #product-photos #wrapper:before {
        content: '';
        position: absolute;

        /* width: 110%;
        height: 110%; */
        left: -25px;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        border-radius: 20px;
        z-index: -1;
        border: 2px dashed #f1f1f1;
    }

    #product-photos #wrapper.highlight:before {
        border: 2px dashed #e1e1e1;
    }

    #product-photos #wrapper.highlight {
        background: #d1d1d1;
    }

    #file-preview img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        display: inline-block;
        position: relative;
        margin: 5px;
    }

    #file-preview img:hover {
        cursor: pointer;
        opacity: .5;
    }

    #file-preview img:after {
        content: 'asfa';
        position: absolute;
        width: 100%;
        height: 100%;
        margin: auto;
        background: rgba(0, 0, 0, .6);
        z-index: 2;
    }

    input[type="file"] {
        display: none;
    }

    label[for="file-upload"] {
        padding: 10px 25px;
        border: 1px solid #a1a1a1;
        border-radius: 20px;
        font-size: 12px;
    }

    label[for="file-upload"]:hover {
        cursor: pointer;
    }



    /* Delete Photo */
    i.delete-btn.fa.fa-trash.fa-3x.text-danger {
        position: absolute;
        left: 40%;
        bottom: 20%;
        z-index: 5;
    }

    div#file-preview a {
        position: relative;
    }
    div#file-preview i.fa-trash {
        display: none;
    }

    div#file-preview a:hover i {
        display: block !important;
        opacity: 0.7
    }
</style>
@endsection



@section('scripts')
<script>
    (function() {
    const wrapper = document.getElementById('wrapper');
    const form = document.getElementById('product-form');
    const fileUpload = document.getElementById('file-upload');
    const fileCount = document.getElementById('file-count');
    const preview = document.getElementById('file-preview');
    const regex = /\.(jpg|png|jpeg)$/;
    let files = [];

    const dragEvents = ['dragstart, dragover', 'dragend', 'dragleave', 'drop'];
    dragEvents.forEach((eventTarget) => {
        wrapper.addEventListener(eventTarget, (e) => {
            e.preventDefault();
            e.stopPropagation();
            console.log('fired');
        });
    });

    window.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
    });
    window.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
    });

    function dragstart() {
        wrapper.classList.add('highlight');
        console.log('dragstart');
    }
    function dragover() {
        wrapper.classList.add('highlight');
        console.log('dragover');
    }
    function dragend() {
        wrapper.classList.remove('highlight');
    }
    function dragleave() {
        wrapper.classList.remove('highlight');
    }

    function checkFile(selectedFiles) {
        for(let file of selectedFiles){
            if(regex.test(file.name)) {
                files.push(file);
            } else {alert('You can only upload images');}
        }
        createPreview(files);
    }

    function dropFiles(e) {
        console.log('drop');
        const transferredFiles = e.dataTransfer.files;
        checkFile(transferredFiles);
        console.log(files);
    }

    function createPreview(filelist) {
        preview.innerHTML = "";
        fileCount.innerHTML = "";
        let count = document.createElement('p');
        count.textContent = `${files.length} ${files.length <= 1 ? 'file' : 'files'} selected `;

        fileCount.appendChild(count);
        filelist.forEach((file) => {
            const img = new Image();
            img.setAttribute('src', URL.createObjectURL(file));
            img.addEventListener('click', () => {
                console.log('clicked');
                files = files.filter((file) => file !== files[img.getAttribute('data-file')]);
                createPreview(files);
            });
            img.dataset.file = filelist.indexOf(file);
            preview.appendChild(img);
        });
    }

    wrapper.addEventListener('dragstart', dragstart);
    wrapper.addEventListener('dragover', dragover);
    wrapper.addEventListener('dragend', dragend);
    wrapper.addEventListener('dragleave', dragleave);
    wrapper.addEventListener('drop', dropFiles);

    fileUpload.addEventListener('change', (e) => {
        const files = e.target.files;
        checkFile(files);
    });

})();
</script>
@endsection
