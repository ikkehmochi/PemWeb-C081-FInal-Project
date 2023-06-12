<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirere</title>
    <link rel="stylesheet" href="styles.css">

    <style>
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom d-none d-sm-none d-md-none d-lg-block bg-white sticky-top">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="index.php"
                class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <span class="fs-3 fw-bold">🍣 Sirere</span>
            </a>
            <button class="btn btn-primary text-white me-2 px-5 fw-500" onclick="location.href='reservation-1.php'"
                type="button"> <i class="fas fa-calendar-plus"></i> &nbsp; &nbsp; Buat
                Reservasi</button>
        </div>
    </header>
    <section class="splide my-4 d-flex justify-content-center align-items-center"
        aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <img src="Data/Images/mainmenu_background.jpg" class="d-block mx-auto rounded" alt="Slide Image">
        </div>
    </section>

    <div class="container">
        <h1 class="text-center text-primary mb-4">Menu Informasi</h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-6 col-md-3">
                <a href="tables.php?lantai=1" class="card">
                    <svg width="100" height="100" viewBox="0 0 1024 1024" class="icon" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M128 928h768c35.3 0 64-28.7 64-64V226.2H64V864c0 35.3 28.7 64 64 64zM64 162.2v64h896v-64c0-35.3-28.7-64-64-64H128c-35.3 0-64 28.7-64 64z m96 29.8c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z m128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"
                            fill="#3D5AFE" />
                        <path d="M160 160m-32 0a32 32 0 1 0 64 0 32 32 0 1 0-64 0Z" fill="#FFEA00" />
                        <path d="M288 160m-32 0a32 32 0 1 0 64 0 32 32 0 1 0-64 0Z" fill="#FFEA00" />
                        <path
                            d="M864.2 449H162c-17.7 0-32-14.3-32-32s14.3-32 32-32h702.2c17.7 0 32 14.3 32 32s-14.4 32-32 32zM800.2 832H166c-17.7 0-32-14.3-32-32s14.3-32 32-32h634.2c17.7 0 32 14.3 32 32s-14.4 32-32 32zM416.1 573H162c-17.7 0-32-14.3-32-32s14.3-32 32-32h254.1c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                            fill="#FFEA00" />
                        <path
                            d="M350.1 544H96c-17.7 0-32-14.3-32-32s14.3-32 32-32h254.1c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                            fill="#FFEA00" />
                        <path
                            d="M224 832.1c-17.7 0-32-14.3-32-32s14.3-32 32-32h398.9C674 695.3 704 606.6 704 510.9c0-21.4-1.5-42.4-4.4-63H162c-17.7 0-32-14.3-32-32s14.3-32 32-32h523.7C668.4 325 639.2 271.2 601 225.1H64v637.8c0 35.3 28.7 64 64 64h294.6c54.7-21.9 104.2-54.4 145.7-94.8H224z"
                            fill="#448AFF" />
                        <path
                            d="M192 800.1c0 17.7 14.3 32 32 32h344.3c20.1-19.6 38.4-41 54.5-64H224c-17.7 0-32 14.3-32 32z"
                            fill="#FFFF00" />
                        <path
                            d="M64 161.1v64h537c-46.1-55.6-105.4-99.8-173-128H128c-35.3 0-64 28.7-64 64z m224-34.2c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.4-32 32-32z m-128 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.4-32 32-32z"
                            fill="#536DFE" />
                        <path
                            d="M130 415.9c0 17.7 14.3 32 32 32h537.6c-3.1-21.9-7.7-43.3-13.9-64H162c-17.7 0-32 14.3-32 32z"
                            fill="#FFFF00" />
                    </svg>
                    <span class="link-text">
                        Table Information
                    </span>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="Tampilan_Booking.php" class="card">
                    <svg width="100" height="100" viewBox="0 0 1024 1024" class="icon" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M960 224v608c0 35.3-28.7 64-64 64H128c-35.3 0-64-28.7-64-64V224c0-17.7 14.3-32 32-32h832c17.7 0 32 14.3 32 32z"
                            fill="#3D5AFE" />
                        <path
                            d="M832 480.2c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32h576c17.7 0 32 14.4 32 32zM832 672.2c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32s14.3-32 32-32h576c17.7 0 32 14.4 32 32z"
                            fill="#FFEA00" />
                        <path
                            d="M224 319.8c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32s32 14.3 32 32v127.8c0 17.7-14.3 32-32 32zM800 319.8c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32s32 14.3 32 32v127.8c0 17.7-14.3 32-32 32z"
                            fill="#536DFE" />
                        <path
                            d="M660.8 704.3H224c-17.7 0-32-14.3-32-32s14.3-32 32-32h461.4c12.1-40.6 18.6-83.5 18.6-128H224c-17.7 0-32-14.3-32-32s14.3-32 32-32h475.5c-14.2-99.8-61.3-189-130-256.3H256v95.8c0 17.7-14.3 32-32 32s-32-14.3-32-32V192H96c-17.7 0-32 14.3-32 32v608c0 35.3 28.7 64 64 64h358.9c75.1-45.2 135.9-112 173.9-191.7z"
                            fill="#536DFE" />
                        <path
                            d="M192 480.3c0 17.7 14.3 32 32 32h480v-0.2c0-21.6-1.5-42.9-4.5-63.8H224c-17.7 0-32 14.3-32 32zM192 672.3c0 17.7 14.3 32 32 32h436.8c9.8-20.5 18-41.9 24.6-64H224c-17.7 0-32 14.3-32 32z"
                            fill="#FFFF00" />
                        <path d="M192 287.8c0 17.7 14.3 32 32 32s32-14.3 32-32V192h-64v95.8z" fill="#8C9EFF" />
                    </svg>
                    <span class="link-text">
                        Book Information
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

</body>

</html>