<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="description" content="Importaciones Leonardo - LeatSact encuentre de todo para su vehículo en un solo lugar.">
    <meta name="language" content="es-PE">
    <meta name="country" content="PER">
    <meta name="currency" content="S/">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="view/images/icon.ico">

    <title>SysSoft Integra</title>

    <link rel="shortcut icon" href="#" />

    <link rel="stylesheet" type="text/css" href="view/css/main.css">
    <link rel="stylesheet" type="text/css" href="view/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="view/css/shop.css">
    <link rel="stylesheet" type="text/css" href="view/css/catalogo.css">
    <style>
        ul li a {
            display: inline-block;
            position: relative;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .active {
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }

        .disabled {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
    </style>
</head>

<body>


    <?php include './header.php'; ?>


    <div class="container">

        <table id="myTable" class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // for ($i = 0; $i <= 100; $i++) {
                //     echo '<tr>
                //     <td>' . ($i + 1) . '</td>
                //     <td>Table cell</td>
                //     <td>Table cell</td>
                //     <td>Table cell</td>
                //     <td>Table cell</td>
                //     <td>Table cell</td>
                //     <td>Table cell</td>
                // </tr>';
                // }
                ?>
            </tbody>
        </table>

        <ul id="datalist">

        </ul>

        <ul class="pagination pagination-lg" id="myPager"></ul>

    </div>

    <?php include './footer.php'; ?>

    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/main.js"></script>
    <script>
        let state = {
            todos: ['a', 'b', 'c', 'd', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', ],
            currentPage: 1,
            todosPerPage: 3, //filas por consulta
            upperPageBound: 3, //columnas por pagina
            lowerPageBound: 0,
            isPrevBtnActive: 'disabled',
            isNextBtnActive: '',
            pageBound: 3
        };

        $(document).ready(function() {
            setPrevAndNextBtnClass(0);
        });

        function render() {
            const {
                todos,
                currentPage,
                todosPerPage,
                upperPageBound,
                lowerPageBound,
                isPrevBtnActive,
                isNextBtnActive
            } = state;

            const indexOfLastTodo = currentPage * todosPerPage;
            const indexOfFirstTodo = indexOfLastTodo - todosPerPage;
            const currentTodos = todos.slice(indexOfFirstTodo, indexOfLastTodo);

            const renderTodos = currentTodos.map((todo, index) => {
                return `<li>${todo}</li>`;
            });

            const pageNumbers = [];
            for (let i = 1; i <= Math.ceil(todos.length / todosPerPage); i++) {
                pageNumbers.push(i);
            }

            const renderPageNumbers = pageNumbers.map(number => {
                if (number === 1 && currentPage === 1) {
                    return (
                        `<li class="active"><a href='#' id=${number} onclick="handleClick(this)">${number}</a></li>`
                    )
                } else if ((number < upperPageBound + 1) && number > lowerPageBound) {
                    return (
                        `<li><a href='#' id=${number} onclick="handleClick(this)">${number}</a></li>`
                    )
                }
            });

            let pageIncrementBtn = null;
            if (pageNumbers.length > upperPageBound) {
                pageIncrementBtn = `<li><a href='#' onclick="btnIncrementClick()"> &hellip; </a></li>`;
            }
            let pageDecrementBtn = null;
            if (lowerPageBound >= 1) {
                pageDecrementBtn = `<li><a href='#' onclick="btnDecrementClick()"> &hellip; </a></li>`;
            }
            let renderPrevBtn = null;
            if (isPrevBtnActive === 'disabled') {
                renderPrevBtn = `<li class='${isPrevBtnActive}'><a href='#' id="btnPrev"> Prev </a></li>`;
            } else {
                renderPrevBtn = `<li class='${isPrevBtnActive}'><a href='#' id="btnPrev" onclick="btnPrevClick()"> Prev </a></li>`;
            }
            let renderNextBtn = null;
            if (isNextBtnActive === 'disabled') {
                renderNextBtn = `<li class='${isNextBtnActive}'><a href='#' id="btnNext"> Next </a></li>`;
            } else {
                renderNextBtn = `<li class='${isNextBtnActive}'><a href='#' id="btnNext" onclick="btnNextClick()"> Next </a></li>`;
            }

            $("#datalist").empty();
            $("#datalist").append(renderTodos);

            $("#myPager").empty();
            $("#myPager").append(renderPrevBtn);
            $("#myPager").append(pageDecrementBtn);
            $("#myPager").append(renderPageNumbers);
            $("#myPager").append(pageIncrementBtn);
            $("#myPager").append(renderNextBtn);

            $("ul li.active").removeClass('active');
            $('ul li a#' + state.currentPage).addClass('active');
        }

        function handleClick(event) {
            let listid = parseInt(event.id);
            state.currentPage = listid;
            $("ul li.active").removeClass('active');
            $('ul li#' + listid).addClass('active');
            setPrevAndNextBtnClass(listid);
        }

        function btnIncrementClick() {
            state.upperPageBound = state.upperPageBound + state.pageBound;
            state.lowerPageBound = state.lowerPageBound + state.pageBound;
            let listid = state.lowerPageBound + 1;
            state.currentPage = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnDecrementClick() {
            state.upperPageBound = state.upperPageBound - state.pageBound;
            state.lowerPageBound = state.lowerPageBound - state.pageBound;
            let listid = state.upperPageBound;
            state.currentPage = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnPrevClick() {
            if ((state.currentPage - 1) % state.pageBound === 0) {
                state.upperPageBound = state.upperPageBound - state.pageBound;
                state.lowerPageBound = state.lowerPageBound - state.pageBound;
            }
            let listid = state.currentPage - 1;
            state.currentPage = listid;
            setPrevAndNextBtnClass(listid);
        }

        function btnNextClick() {
            if ((state.currentPage + 1) > state.upperPageBound) {
                state.upperPageBound = state.upperPageBound + state.pageBound;
                state.lowerPageBound = state.lowerPageBound + state.pageBound;
            }
            let listid = state.currentPage + 1;
            state.currentPage = listid;
            setPrevAndNextBtnClass(listid);
        }

        function setPrevAndNextBtnClass(i) {
            let listid = parseInt(i);
            let totalPage = Math.ceil(state.todos.length / state.todosPerPage);
            state.isNextBtnActive = 'disabled';
            state.isPrevBtnActive = 'disabled';

            if (totalPage === listid && totalPage > 1) {
                state.isPrevBtnActive = '';
            } else if (listid === 1 && totalPage > 1) {
                state.isNextBtnActive = '';
            } else if (totalPage > 1) {
                state.isNextBtnActive = '';
                state.isPrevBtnActive = '';
            }
            render();
        }
    </script>
</body>

</html>