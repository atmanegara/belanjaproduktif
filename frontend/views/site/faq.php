<div class='page-container'>
        <!-- BEGIN #page-header -->
        <div id="page-header" class="section-container page-header-container bg-black">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                <img src="../assets/img/cover/cover-13.jpg" alt="" />
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header">Frequently Asked <b>Questions</b></h1>
            </div>
            <!-- END container -->
        </div>
        <!-- BEGIN #page-header -->
        
        <!-- BEGIN #faq -->
        <div id="faq" class="section-container">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-12">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Support</a></li>
                    <li class="active">FAQs</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN panel-group -->
                <div class="panel-group faq" id="faq-list">
          <?php 
          $no=1;
          foreach ($model as $value) { ?>

                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#faq-<?=$no?>"><i class="fa fa-question-circle fa-fw m-r-5"></i> <?=$no?>. <?=$value['pertanyaan']?>. </a>
                            </h4>
                        </div>
                        <div id="faq-<?=$no?>" class="panel-collapse collapse ">
                            <div class="panel-body">
                                <p>
                                    <?=$value['jawaban']?>.
                                </p>
                            </div>
                        </div>
                    </div>
          <?php $no++;} ?>
                    <!-- END panel -->
                    <!-- BEGIN panel -->
                    
                    <!-- END panel -->
                    <!-- BEGIN panel -->
          
                    <!-- END panel -->
                    <!-- BEGIN panel -->
                    
                    <!-- END panel -->
                </div>
                <!-- END panel-group -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #faq -->
</div>