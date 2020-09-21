    <?php include "config.php"; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Export 2 CSV Example</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success text-white text-bold">List of Users</div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM USERS LIMIT 10";
                            $st = $dbcon->prepare($sql);
                            $st->execute();
                            $users = $st->fetchAll(PDO::FETCH_CLASS);
                            ?>
                            <form action="process.php" method="POST" class="mb-5">
                                <button name="submit" class="btn btn-warning text-white">Export Excel</button>
                            </form>
                            <table class="table table-bordered">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <tbody>
                                    <?php foreach ($users as $val) : ?>
                                        <tr>
                                            <td><?php echo $val->name; ?></td>
                                            <td><?php echo $val->email; ?></td>
                                            <td><?php echo $val->created_at; ?></td>
                                            <td><?php echo $val->updated_at; ?></td>
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