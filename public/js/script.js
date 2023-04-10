// const form = document.querySelector(".uploadForm"),
//     fileInput = form.querySelector(".file-input"),
//     progressArea = document.querySelector(".progress-area"),
//     uploadArea = document.querySelector(".uploaded-area"),
//     form1 = document.querySelector(".upForm");

// form.addEventListener("click", () => {
//     fileInput.click();
// });

// fileInput.onchange = ({ target }) => {
//     let file = target.files[0];
//     if (file) {
//         let fileName = file.name;
//         if (fileName.length >= 12) {
//             let spliteName = fileName.split('.');
//             fileName = spliteName[0].substring(0, 12) + "... ." + spliteName[1];
//         }
//         uploadFile(fileName);
//     }
// }

// function uploadFile(name) {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "upload.php");
//     xhr.upload.addEventListener("progress", ({ loaded, total }) => {
//         let fileLoaded = Math.floor((loaded / total) * 100);
//         let fileTotal = Math.floor(total / 1000);
//         uploadArea.innerHTML = "";
//         let progressHTML = `<li class="row">
//                             <i class="fas fa-file-alt"></i>
//                             <div class="content">
//                                 <div class="details">
//                                     <span class="name">${name} .uploading </span>
//                                     <span class="percent">${fileLoaded}%</span>
//                                 </div>
//                                 <div class="progress-bar">
//                                     <div class="progress" style="width:${fileLoaded}%"></div>
//                                 </div>
//                             </div>
//                         </li>`;

//         progressArea.innerHTML = progressHTML;

//         if (loaded == total) {
//             progressArea.innerHTML = "";
//             let uploadedHTML = `<li class="row">
//                                     <div class="content">
//                                         <i class="fas fa-file-alt"></i>
//                                         <div class="details">
//                                             <span class="name">${name}.uploading </span>
//                                             <span class="size">${fileTotal}KB</span>
//                                         </div>
//                                     </div>
//                                     <i class="fas fa-check"></i>
//                                 </li>`;
//             uploadArea.innerHTML = uploadedHTML;
//         }
//     });
//     let formData = new FormData(form);
//     xhr.send(formData);
// }


// EMG
$("form#emgData").submit(function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append( 'file', $( '#emgFile')[0].files[0] );
    $.ajax({
        url: "https://seizure-model-connection.herokuapp.com/EMG",
        type: 'POST',
        data: formData,
        beforeSend:function(){
            $('#emgBtn').text('')
            $('#emgBtn').append(`
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            `)
        },
        success: function (data) {
            console.log(data)
            console.log(data.className)
            console.log(data.probabilityOfNoSeizure)
            console.log(data.probabilityOfSeizure)
            $("div#con").text('')
            $("div#con").append(`
            <h2>Signal Results</h2>

            <div id="result" class="row">
                 <p>
                    <span class="emgLabel">class Name: </span><span class="emgResult" id="emgName"></span>
                 </p>
                 <p>
                    <span class="emgLabel">Probabilitiy of Seizure: </span><span class="emgResult" id="emgSeiz"></span>
                 </p>
                 <p>
                    <span class="emgLabel">probabilitiy of non seizure: </span><span class="emgResult" id="emgNonSeiz"></span>
                 </p>
            </div>
            `)
            $("span#emgName").text(data.className)
            $("span#emgSeiz").text(data.probabilityOfSeizure +' %')
            $("span#emgNonSeiz").text(data.probabilityOfNoSeizure + ' %')
            $('html, body').animate({
                scrollTop: $("#result").offset().top
            }, 100);
        },
        error:function (request, status, error){
            console.log(request)
            console.log(status)
            console.log(error)
        },
        complete:function(){
            $('#emgBtn').text('')
            $('#emgBtn').text('Submit')
          },
        cache: false,
        contentType: false,
        processData: false
    });
});



// eeg
$("form#eegData").submit(function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append( 'file', $( '#eegFile')[0].files[0] );
    $.ajax({
        url: "https://seizure-model-connection.herokuapp.com/EEG",
        type: 'POST',
        data: formData,
        beforeSend:function(){
            $('#emgBtn').text('')
            $('#emgBtn').append(`
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            `)
        },
        success: function (data) {
            console.log(data)
            console.log(data.className)
            console.log(data.probabilityOfNoSeizure)
            console.log(data.probabilityOfSeizure)
            $("div#con2").text('')
            $("div#con2").append(`
            <h2>Signal Results</h2>

            <div id="result" class="row">
                 <p>
                    <span class="emgLabel">class Name: </span><span class="emgResult" id="eegName"></span>
                 </p>
                 <p>
                    <span class="emgLabel">Probabilitiy of Seizure: </span><span class="emgResult" id="eegSeiz"></span>
                 </p>
                 <p>
                    <span class="emgLabel">probabilitiy of non seizure: </span><span class="emgResult" id="eegNonSeiz"></span>
                 </p>
            </div>
            `)
            $("span#eegName").text(data.className)
            $("span#eegSeiz").text(data.probabilityOfSeizure +' %')
            $("span#eegNonSeiz").text(data.probabilityOfNoSeizure + ' %')
            $('html, body').animate({
                scrollTop: $("#resultEeg").offset().top
            }, 100);
        },
        error:function (request, status, error){
            console.log(request)
            console.log(status)
            console.log(error)
        },
        complete:function(){
            $('#emgBtn').text('')
            $('#emgBtn').text('Submit')
          },
        cache: false,
        contentType: false,
        processData: false
    });
});
