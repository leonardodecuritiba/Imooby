  <script>
        d4sign.configure({
            container: "signature-div",
            key: "{{ $document_uuid }}",
            protocol: "https",
            host: "secure.d4sign.com.br/embed/viewblob",
            signer: {
                email: "{{ $signer_email }}",
                display_name: "{{ $signer_name }}"
                {!! ($signer_cpf != null ? ', documentation: "'.$signer_cpf.'"' : '') !!}
            },
            callback: function(event) {
              if (event.data === "signed") {
                // callback de assinado
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", '{{ url('verify-negotiation-signature/'.$negotiation_id) }}', true);
                xmlHttp.send( null );                
              }
          }
      });
  </script>