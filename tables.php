<?php
include_once("conn.php");
$targeted_floor = $_GET["lantai"];
$select_query="SELECT * FROM meja WHERE lantai=$targeted_floor";
$select_exec=$conn->query($select_query);

  /**
  * Check wether table is reserved or not
  * 
  *
  * @param    int  $table_id
  * @return   bool
  *
  */
function check_reserve($table_id){

  $query="SELECT waktu FROM booking LEFT JOIN meja ON booking.no_meja_fk = meja.no_meja WHERE booking.no_meja_fk=$table_id;";
  $dine_exec=$GLOBALS['conn']->query($query);
  if($dine_exec->fetchColumn()){
    return true;
  }else{
    return false;
  }
}

  /**
  * Check how many hours untill reservation
  * 
  *
  * @param    int  $table_id
  * @return   int
  *
  */
function check_reserve_time($table_id){
  date_default_timezone_set("Asia/Bangkok");
  $query="SELECT waktu FROM booking LEFT JOIN meja ON booking.no_meja_fk = meja.no_meja WHERE booking.no_meja_fk=$table_id;";
  $dine_exec=$GLOBALS['conn']->query($query);
  $reservation_date=new DateTimeImmutable($dine_exec->fetchColumn());
  $todays_date=new DateTimeImmutable(date("Y-m-d h:i:sa"));
  $time_to_reservation=(int)$reservation_date->diff($todays_date)->format("%R%h");
  return $time_to_reservation;
}

  /**
  * get the reservation detail (reserver name and reserve id) of targeted table
  * 
  *
  * @param    int  $table_id
  * @return   array
  *
  */
function get_reserve_detail($table_id){
  date_default_timezone_set("Asia/Bangkok");
  $query="SELECT id_booking, nama_dipesan FROM booking LEFT JOIN meja ON booking.no_meja_fk = meja.no_meja WHERE booking.no_meja_fk=$table_id;";
  $reserve_details=$GLOBALS['conn']->query($query)->fetch();
  return $reserve_details;
}
  /**
  * get the reservation time of targeted table
  * 
  *
  * @param    int  $table_id
  * @return   string
  *
  */
  function get_reserve_time($table_id){
    date_default_timezone_set("Asia/Bangkok");
    $query="SELECT waktu FROM booking LEFT JOIN meja ON booking.no_meja_fk = meja.no_meja WHERE booking.no_meja_fk=$table_id;";
    $reserve_exec=$GLOBALS['conn']->query($query)->fetchColumn();
    $todays_date=explode(" ", $reserve_exec);
    return $todays_date[1];
  }
  /**
  * get the total floor of the database
  * 
  *
  * @return   array
  *
  */
  function get_floor(){
    $query="SELECT DISTINCT lantai from meja;";
    $floor_exec=$GLOBALS['conn']->query($query)->fetchAll();
    $floors=array();
    foreach($floor_exec as $floor){
        array_push($floors, $floor["lantai"]);
    }
    return $floors;
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="viewtables.css" />
    <title>Daftar Meja</title>

</head>

<body>
    <button onclick="location.href='index.php'" class="learn-more">
        <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
        </span>
        <span class="button-text">Back</span>
    </button>
    <div class='container'>
        <div class="content">
            <?php
    while($table = $select_exec->fetch(PDO::FETCH_ASSOC)){
      $table_info="";
      if((check_reserve($table["no_meja"]))&&(check_reserve_time($table["no_meja"])==0) && ($table["status_meja"]==0)){
        header("location:reserve.php?table_id=$table[no_meja]");
    }
        if($table["status_meja"]==0){
            $status_meja="AVAILABLE";
            $table_info="AVAILABLE";
            $img_url="Data\Images\meja_available.png";
            $btn_img="Data\Images\Dine.png";
            $btn_alt="Dine In";
            $btn_url="dinein.php";
        }elseif($table["status_meja"]==1){
            $status_meja="OCCUPIED";
            $table_info="OCCUPIED";
            $img_url="Data\Images\meja_occupied.png";
            $btn_img="Data\Images\done.png";
            $btn_alt="Done";
            $btn_url="done_dining.php";
        }elseif($table["status_meja"]==2){
            $reserved_time=get_reserve_time($table["no_meja"]);
            $status_meja="RESERVED bzr";
            $table_info="RESERVED AT $reserved_time";
            $img_url="Data\Images\meja_reserved.png";
            $btn_img="Data\Images\Dine.png";
            $btn_alt="Dine In";
            $btn_url="dine_reservation.php";
        }else{
          $status_meja="OCCUPIED bzr";
          $table_info="OCCUPIED";
          $img_url="Data\Images\meja_occupied.png";
          $btn_img="Data\Images\done.png";
          $btn_alt="Done";
          $btn_url="done_reservation.php";
        }
        echo "
        <div class='table-content'>
          <div class='table-num'>$table[no_meja]</div>
          <div class='table-image'>
            <img
            src=$img_url
            alt='meja_$status_meja'
            class='table-img'
          /></div>
            <div class='table-capacity table-capacity-$status_meja'>NUMBER OF SEATS : $table[jumlah_kursi]</div>
            <div class='table-status table-status-$status_meja'>
            $table_info
            </div>
            <div class='table-btn'>
              <a href=$btn_url?table_id=$table[no_meja]><img src=$btn_img alt=$btn_alt /></a>
            </div>";
            if($table["status_meja"]==2 || $table["status_meja"]==3){
              $reserve_detail=get_reserve_detail($table["no_meja"]);
              echo 
              "<div class='reserve_details'>
              $reserve_detail[0]. $reserve_detail[1]
              </div>";
            }
            
          echo"</div>";}
          
          ?>
        </div>
    </div>
    <div class="pagination">
        <span class="pagination__number-indicator"></span>
        <button onclick="location.href='tables.php?lantai=1'" class="pagination__arrow pagination__arrow--down">
            <span class="pagination__arrow-half"></span>
            <span class="pagination__arrow-half"></span>
        </button>
        <a href="tables.php?lantai=1">
            <button
                class="pagination__number <?php if ($_GET['lantai'] == 1) echo 'pagination__number--active'; ?>">1</button>
        </a>
        <a href="tables.php?lantai=2">
            <button
                class="pagination__number <?php if ($_GET['lantai'] == 2) echo 'pagination__number--active'; ?>">2</button>
        </a>
        <button onclick="location.href='tables.php?lantai=2'" class="pagination__arrow pagination__arrow--up">
            <span class="pagination__arrow-half"></span>
            <span class="pagination__arrow-half"></span>
        </button>
    </div>

</body>
<script>
const pagination = document.querySelector('.pagination')

if (pagination) {
    const paginationNumbers = document.querySelectorAll('.pagination__number')
    let paginationActiveNumber = document.querySelector('.pagination__number--active')
    const paginationNumberIndicator = document.querySelector('.pagination__number-indicator')
    const paginationLeftArrow = document.querySelector('.pagination__arrow:not(.pagination__arrow--right)')
    const paginationRightArrow = document.querySelector('.pagination__arrow--right')

    const positionIndicator = (element) => {
        const paginationRect = pagination.getBoundingClientRect()
        const paddingElement = parseInt(window.getComputedStyle(element, null).getPropertyValue('padding-left'),
            10)
        const elementRect = element.getBoundingClientRect()
        paginationNumberIndicator.style.left = `${elementRect.left + paddingElement - paginationRect.left}px`
        paginationNumberIndicator.style.width = `${elementRect.width - paddingElement * 2}px`
        if (element.classList.contains('pagination__number--active')) {
            paginationNumberIndicator.style.opacity = 1
        } else {
            paginationNumberIndicator.style.opacity = 0.2
        }
    }

    const setActiveNumber = (element) => {
        if (element.classList.contains('pagination__number--active')) return
        element.classList.add('pagination__number--active')
        paginationActiveNumber.classList.remove('pagination__number--active')
        paginationActiveNumber = element
        setArrowState()
    }

    const disableArrow = (arrow, disable) => {
        if (
            (!disable && !arrow.classList.contains('pagination__arrow--disabled')) ||
            (disable && arrow.classList.contains('pagination__arrow--disabled'))
        )
            return
        if (disable) {
            arrow.classList.add('pagination__arrow--disabled')
        } else {
            arrow.classList.remove('pagination__arrow--disabled')
        }
    }

    const setArrowState = () => {
        const previousElement = paginationActiveNumber.previousElementSibling
        const nextElement = paginationActiveNumber.nextElementSibling
        if (previousElement.classList.contains('pagination__number')) {
            disableArrow(paginationLeftArrow, false)
        } else {
            disableArrow(paginationLeftArrow, true)
        }

        if (nextElement.classList.contains('pagination__number')) {
            disableArrow(paginationRightArrow, false)
        } else {
            disableArrow(paginationRightArrow, true)
        }
    }

    paginationLeftArrow.addEventListener('click', () => {
        setActiveNumber(paginationActiveNumber.previousElementSibling)
        positionIndicator(paginationActiveNumber)
    })

    paginationRightArrow.addEventListener('click', () => {
        setActiveNumber(paginationActiveNumber.nextElementSibling)
        positionIndicator(paginationActiveNumber)
    })

    Array.from(paginationNumbers).forEach((element) => {
        element.addEventListener('click', () => {
            setActiveNumber(element)
            positionIndicator(paginationActiveNumber)
        })

        element.addEventListener('mouseover', () => {
            positionIndicator(element)
        })

        element.addEventListener('mouseout', () => {
            positionIndicator(paginationActiveNumber)
        })
    })

    positionIndicator(paginationActiveNumber)
}
</script>

</html>