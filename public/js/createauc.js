function setEndDateMinMaxValue(){

    let now     = new Date();

    let mindate = new Date(now.setHours(now.getHours() + 1));
    let minyear    = mindate.getFullYear();
    let minmonth   = mindate.getMonth()+1;
    let minday     = mindate.getDate();
    let minhour    = mindate.getHours();
    let minminute  = mindate.getMinutes();

    if(minmonth.toString().length === 1) {
        minmonth = '0'+minmonth;
    }
    if(minday.toString().length === 1) {
        minday = '0'+minday;
    }
    if(minhour.toString().length === 1) {
        minhour = '0'+minhour;
    }
    if(minminute.toString().length === 1) {
        minminute = '0'+minminute;
    }

    let maxdate = new Date(now.setMonth(now.getMonth()+6));
    let maxyear    = maxdate.getFullYear();
    let maxmonth   = maxdate.getMonth()+1;
    let maxday     = maxdate.getDate();
    let maxhour    = maxdate.getHours();
    let maxminute  = maxdate.getMinutes();

    if(maxmonth.toString().length === 1) {
        maxmonth = '0'+maxmonth;
    }
    if(maxday.toString().length === 1) {
        maxday = '0'+maxday;
    }
    if(maxhour.toString().length === 1) {
        maxhour = '0'+maxhour;
    }
    if(maxminute.toString().length === 1) {
        maxminute = '0'+maxminute;
    }

    const min = minyear + '-' + minmonth + '-' + minday + 'T' + minhour + ':' + minminute;
    const max = maxyear + '-' + maxmonth + '-' + maxday + 'T' + maxhour + ':' + maxminute;

    const dateControl2 = document.getElementById('enddate2');
    if(dateControl2 != null){
        dateControl2.value = min;
        dateControl2.min = min;
        dateControl2.max = max;
    }

    const dateControl = document.getElementById('enddate');
    if(dateControl != null){
        dateControl.min = min;
        dateControl.max = max;
    }


}setEndDateMinMaxValue();

const image = document.getElementById('auc_pic');
let img = document.querySelector('img');
let upload = "";
if(image != null){
    image.addEventListener('change', function() {
        console.log(image.value);
        const reader = new FileReader();
        reader.readAsDataURL(image.files[0]);
        reader.addEventListener('load', function() {
            document.getElementById('display-image').innerHTML = `<img class="img-fluid" src="${reader.result}" alt="User Image" width="100%" height="100%">`;

        });
    });
}



