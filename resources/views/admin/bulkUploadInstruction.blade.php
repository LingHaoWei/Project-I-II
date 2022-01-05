@extends('layout')
@section('content')
<style>
    .instruction{
        padding:10px;
    }
</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>How to bulk upload products?</h2></div>
            </div>  

        </div>
    </div>

    <div class="" id="pwrapper2">
        <div class="instruction">
            <h3>Bulk Upload Instruction:</h3>

            <p>1. Create an excel file, follow the example template as shown below. Format must be followed <b>exactly the same</b>.</p>

            <div><img src="/images/ExampleTemplate.png" alt="" width="50%" height="100%"></div>
            
            <p><b><i>*For the image, it should be ready in the project public/images folder. You can type the image name under the imgae column e.g. Example.jpg</i></b></p>
            <p>2. Bulk upload only accepts CSV file format. Therefore, after you have done inserting all the data into the excel file, please save it as .CSV file. </p>

            <p>3. Next, go to the product page, and click on the choose file and select your saved CSV file.</p>

            <div><img src="/images/uploadInstruction01.png" alt="" width="50%" height="100%"></div>

            <p>4. Once you have selected your CSV file, the file name will appear after Choose File.</p>

            <p>5. Now you can click on the upload button to finish the bulk upload! </p>

            <div><img src="/images/uploadInstruction03.png" alt="" width="50%" height="100%"></div>

            
        </div>    
    

    </div>

@endsection