<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatos Cadastrados</title>
</head>
<body>
  <h1 class="ml-4 mt-2">Contatos</h1>
  <hr>
  <div class="container">
    <table class="table table-bordered table-striped" style="top:40px;">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th><a href="?controller=ContactsController&method=create" class="btn btn-success btn-sm">Novo</a></th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($contacts)
          {
            foreach($contacts as $contact)
            {
              echo "<tr>";
                echo "<td>{$contact->name}</td>";
                echo "<td>{$contact->phone}</td>";
                echo "<td>{$contact->email}</td>";
                echo "<td>";
                  echo "<a href='?controller=ContactsController&method=edit&id={$contact->id}' class='btn btn-primary btn-sm mr-2'>Editar</a>";
                  echo "<a href='?controller=ContactsController&method=destroy&id={$contact->id}' class='btn btn-danger btn-sm'>Excluir</a>";
                echo "</td>";
              echo "</tr>";
            }
          }
          else
          {
            echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>