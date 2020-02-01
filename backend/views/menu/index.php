<?php

use yii\helpers\Html;
use wbraganca\fancytree\FancytreeWidget;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройка меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">


<div class="row">



    <section class="col-md-6">
        <div class="card">
            <div class="card-header ui-sortable-handle">
                <h3 class="card-title">
                    <i class="fas fa-bars"></i>
                    Меню
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <button class="btn btn-success" id="addnewmenu"><i class="fal fa-plus-circle"></i></button>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">

                <?php

                echo FancytreeWidget::widget([
                    'options' =>[
                        'source' => $data,
                        'extensions' => ['dnd'],
                        'dnd' => [
                            'preventVoidMoves' => true,
                            'preventRecursiveMoves' => true,
                            'autoExpandMS' => 400,
                            'dragStart' => new JsExpression('function(node, data) {
                                return true;
                            }'),
                            'dragEnter' => new JsExpression('function(node, data) {
                                return true;
                            }'),
                            'dragDrop' => new JsExpression('function(node, data) {
                                $.get("index.php?r=menu%2Fmove",{item:data.otherNode.data.id, action: data.hitMode, second: node.data.id}, function() {
                                data.otherNode.moveTo(node, data.hitMode);
                                });
                            }'),
                        ],
                        'activate' => new JsExpression('function(event, data) {
                            var title = data.node.title;
                            var id = data.node.data.id;
                            $(".card-ajax-header").text(" Редактировать пункт: " + title);
                            $.get("index.php?r=menu%2Fview",{id: id},function(data) {
                                $(".card-ajax-body").html(data);
                            });
                }'),
                    ]
                ]);
                ?>


            </div><!-- /.card-body -->
        </div>

    </section>


    <section class="col-md-6 connectedSortable ui-sortable">

        <!-- Map card -->
        <div class="card bg-gradient-primary" style="position: relative; left: 0px; top: 0px;">
            <div class="card-header border-0 ui-sortable-handle">
                <h3 class="card-title">
                    <i class="fas fa-bars"></i>  <i class="card-ajax-header"></i>
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                        <i class="far fa-calendar-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body card-ajax-body">


                <?php

                function view_cat($arr,$parent_id = 0) {

                    //Условия выхода из рекурсии
                    if(empty($arr[$parent_id])) {
                        return;
                    }
                    echo '<ul>';
                    //перебираем в цикле массив и выводим на экран
                    for($i = 0; $i < count($arr[$parent_id]);$i++) {
                        echo '<li><a href="?category_id='.$arr[$parent_id][$i]['id'].
                            '&parent_id='.$parent_id.'">'
                            .$arr[$parent_id][$i]['name'].'</a>';
                        //рекурсия - проверяем нет ли дочерних категорий
                        view_cat($arr,$arr[$parent_id][$i]['id']);
                        echo '</li>';
                    }
                    echo '</ul>';

                }
                echo view_cat($data);
                ?>


            </div>

        </div>
        <!-- /.card -->


    </section>
</div>

</div>

<? $this->registerJs('addnewmenu.onclick=function addnewmenu(data){$(".card-ajax-header").text("Добавить новый пункт меню");$.get("index.php?r=menu%2Fcreate",function(data) {$(".card-ajax-body").html(data);});}')?>
