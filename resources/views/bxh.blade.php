<div class="box_header d-flex justify-content-between align-items-end">
   <a class="view_all"><h4 style="color: #007efc;" class="title m-0"><b> Bảng xếp hạng</b></h4></a>
</div>
    <br>
    <ul class="nav nav-tabs" id="myTab_bxh" role="tablist" style="width: 100%">
        <li class="nav-item">
            <a class="nav-link active show" onclick="showvn()" style="font-size: 13px;color: #007efc;font-weight: bold;width: 100%" data-link-bxh="/nhac-hot.html" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">VIỆT NAM</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"onclick="showus()" style="font-size: 13px;color: #222222;font-weight: bold;width: 100%" data-link-bxh="/nhac-hot.html?tab=us-uk" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">US-UK</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"onclick="showhan()" style="font-size: 13px;color: #222222;font-weight: bold;width: 100%" data-link-bxh="/nhac-hot.html?tab=korea" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">K-POP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"onclick="showhoa()" style="font-size: 13px;color: #222222;font-weight: bold;width: 100%" data-link-bxh="/nhac-hot.html?tab=japan" id="jpop-tab" data-toggle="tab" href="#jpop" role="tab" aria-controls="jpop" aria-selected="false">HOA</a>
        </li>
    </ul>
<br>
<br>
    <div id="BXHVN" style="position: absolute;visibility: visible;width: 100%">
        @include('bxh.bxhvn')
    </div>
    <div id="BXHUS" style="position: absolute;visibility: hidden;width: 100%">
        @include('bxh.bxhus')
    </div>
    <div id="BXHHOA" style="position: absolute;visibility: hidden;width: 100%">
        @include('bxh.bxhhoa')
    </div>
    <div id="BXHHAN" style="position: absolute;visibility: hidden;width: 100%">
        @include('bxh.bxhhan')
    </div>
<script>
    function showvn(){
        document.getElementById('BXHVN').style.visibility= 'visible';
        document.getElementById('home-tab').style.color = '#007efc';
        document.getElementById('profile-tab').style.color='#222222';
        document.getElementById('contact-tab').style.color='#222222';
        document.getElementById('jpop-tab').style.color='#222222';
        document.getElementById('BXHHOA').style.visibility= 'hidden';
        document.getElementById('BXHHAN').style.visibility= 'hidden';
        document.getElementById('BXHUS').style.visibility= 'hidden';
    }
    function showus(){
        document.getElementById('BXHVN').style.visibility= 'hidden';
        document.getElementById('home-tab').style.color = '#222222';
        document.getElementById('profile-tab').style.color='#007efc';
        document.getElementById('contact-tab').style.color='#222222';
        document.getElementById('jpop-tab').style.color='#222222';
        document.getElementById('BXHHOA').style.visibility= 'hidden';
        document.getElementById('BXHHAN').style.visibility= 'hidden';
        document.getElementById('BXHUS').style.visibility= 'visible';
    }
    function showhan(){
        document.getElementById('BXHVN').style.visibility= 'hidden';
        document.getElementById('home-tab').style.color = '#222222';
        document.getElementById('profile-tab').style.color='#222222';
        document.getElementById('contact-tab').style.color='#007efc';
        document.getElementById('jpop-tab').style.color='#222222';
        document.getElementById('BXHHOA').style.visibility= 'hidden';
        document.getElementById('BXHHAN').style.visibility= 'visible';
        document.getElementById('BXHUS').style.visibility= 'hidden';
    }
    function showhoa(){
        document.getElementById('BXHVN').style.visibility= 'hidden';
        document.getElementById('home-tab').style.color = '#222222';
        document.getElementById('profile-tab').style.color='#222222';
        document.getElementById('contact-tab').style.color='#222222';
        document.getElementById('jpop-tab').style.color='#007efc';
        document.getElementById('BXHHOA').style.visibility= 'visible';
        document.getElementById('BXHHAN').style.visibility= 'hidden';
        document.getElementById('BXHUS').style.visibility= 'hidden';
    }
</script>
