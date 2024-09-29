<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Contato</title>
</head>
<body>
  <div class="container">
    <form action="?controller=ContactsController&<?= isset($contact->id) ? "method=update&id={$contact->id}" : "method=save"; ?>" method="post">
      <div class="card" style="top:40px">
        <div class="card-header">
          <span class="card-title">Contatos</span>
        </div>
        <div class="card-body">
          <div class="form-group form-row">
            <label class="col-sm-2 col-form-label text-right">Nome:</label>
            <input type="text" class="form-control col-sm-8" name="name" id="name" value="<?= isset($contact->name) ? $contact->name : null; ?>">
          </div>
          <div class="form-group form-row">
            <label class="col-sm-2 col-form-label text-right">Telefone:</label>
            <input type="text" class="form-control col-sm-8" name="phone" id="phone" value="<?= isset($contact->phone) ? $contact->phone : null; ?>">
          </div>
          <div class="form-group form-row">
            <label class="col-sm-2 col-form-label text-right">E-mail:</label>
            <input type="text" class="form-control col-sm-8" name="email" id="email" value="<?= isset($contact->email) ? $contact->email : null; ?>">
          </div>
        </div>
        <div class="card-footer">
          <input type="hidden" name="id" id="id" value="<?= isset($contact->id) ? $contact->id : null ?>">
          <button class="btn btn-success" type="submit">Salvar</button>
          <button class="btn btn-secondary">Limpar</button>
          <a class="btn btn-danger" href="?controller=ContactsController&method=index">Cancelar</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>