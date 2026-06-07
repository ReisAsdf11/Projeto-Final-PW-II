<?php
  require_once 'classes/Carteira.php';
  session_start();

  if (!isset($_SESSION['carteira'])) {
    $_SESSION['carteira'] = new Carteira();
  }
  $carteira = $_SESSION['carteira'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPocket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1>MyPocket</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Saldo Atual: R$<?= number_format($carteira->getSaldo(),2,',','.') ?></h5>
                        <?php
                          if (isset($_SESSION['erro'])){ 
                            echo $_SESSION['erro'];
                            unset($_SESSION['erro']);
                        }
                        ?>
                        <form action="processa.php" method="POST">
                          <div class="mb-2">
                              <label class="form-label small">Valor</label>
                              <input type="number" name="valor" class="form-control" required>
                          </div>
                          <div class="mb-2">
                              <label class="form-label small">Data</label>
                              <input type="date" name="data" class="form-control" required>
                          </div>
                          <div class="mb-2">
                            <label class="form-label small">Descrição</label>
                            <input type="text" name="descricao" class="form-control" required>
                          </div>
                            <div class="mb-3">
                                <label class="form-label small">Tipo</label>
                                <select name="tipo" class="form-select">
                                    <option value="receita">Receita</option>
                                    <option value="despesa">Despesa</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Salvar Transação</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Tipor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($carteira->getTransacoes())): ?>
                                    <tr>
                                      <td colspan="4" class="text-center py-4 text-muted">Nenhuma transação</td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($carteira->getTransacoes() as $transacao): ?>
                                    <tr>
                                        <td class="align-middle fw-bold">R$<?= number_format($transacao->getValor(), 2, ',', '.')?></td>
                                        <td class="align-middle"><?= $transacao->getData() ?></td>
                                        <td class="align-middle"><?= $transacao->getDescricao() ?></td>
                                        <td class="align-middle">
                                            <?php if ($transacao->getTipo() === 'Entrada'): ?>
                                              <span class="badge bg-success">Receita</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Despesa</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>