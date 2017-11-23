
    </div>

    <?php
    $session = $this->session->userdata('esta_logado');
    if($session == true):
        ?>

        <footer id="site-footer">
            <p>Copyright &copy; 2017, Ajude+</p>
        </footer>

    <?php endif; ?>

    <?php
    $js = array(
        'jquery-3.2.1.min.js',
        'jquery.mask.min.js',
        'popper.min.js',
        'bootstrap.min.js',
        'mdb.min.js',
        'funcoes.js'
    );

    echo assets_js($js);
    ?>

    <script type="text/javascript">
        /*
         Função para buscar os detalhes de um produto
        */
        function buscarDetalhesProduto(id) {
            $('.modal-title').html('Detalhes do produto');
            var url = base_url + 'detalhes/buscarDetalhes/' + id;
            $.get(url, function (dados) {
                $('#conteudo').html(dados);
            });
        }
        /*
         Fim função
        */
    </script>

    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSa_CZuFVTYbPuZTFIFeGgkT8RhZvl9YA&callback=initMap" type="text/javascript"></script> -->

    </body>
</html>