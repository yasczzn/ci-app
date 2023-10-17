<style>
    table, td, th {
        border: 1px solid #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    td, th {
       padding: 2px; 
    }
    th {
        background-color: #CCC;
    }
</style>
<h2 class="mt-2">Data Orang</h2>
<div class="table-wrapper">  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($orang as $o) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $o['name']; ?></td>
                    <td><?= $o['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>