<Style>
    .footer {
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px 20px;
        background-color: #fff;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 100%;

    }

    .footer1 p {
        padding: 0;
        margin: 0;
        font-size: 11px;
        color: #676A6C;
    }

    .footer2 p {
        padding: 0;
        margin: 0;
        font-size: 13px;
        color: #676A6C;
    }

    .footer2 p strong {
        font-weight: 700;
    }
</Style>


<div class="footer">
    <div class="footer1">
        <p>Copyright <strong>HR Partner </strong>© 2023. All Rights Reserved</p>
    </div>
    <div class="footer2">
        <p>Department: <strong><?php echo $_SESSION['departament']; ?></strong></p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>