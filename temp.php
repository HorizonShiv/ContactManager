<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of all Contact filled form</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>User Name</th>
                                            <th>Contact Number 1</th>
                                            <th>Contact Number 2</th>
                                            <th>Contact Number 3</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $temp = 1;
                                        if ($GetContact->num_rows > 0) :
                                            foreach ($GetContact as $row) :
                                        ?>
                                                <tr style="margin-top: 50px;">
                                                    <td>
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?php echo $temp; ?>">
                                                            <label for="checkbox-<?php echo $temp; ?>" class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['ContactName']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['ContactNumber1']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['ContactNumber2'] == 0) {
                                                            echo 'Null';
                                                        } else {
                                                            echo $row['ContactNumber2'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['ContactNumber3'] == 0) {
                                                            echo 'Null';
                                                        } else {
                                                            echo $row['ContactNumber3'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $tempDate = explode('-', $row['Date']);
                                                        echo $tempDate[2] . '-' . $tempDate[1] . '-' . $tempDate[0];
                                                        ?>
                                                    </td>
                                                    <td>

                                                        <!-- <a href="#" class="btn btn-secondary">Detail</a>&nbsp;&nbsp; -->
                                                        <a href="BackEnd/DbDelete.php?TokenType=contact&TokenId=<?php echo $row['ContactID']; ?>" class="btn btn-icon btn-danger" onclick="return Surety()"><i class="fas fa-times"></i></a>

                                                    </td>
                                                </tr>
                                        <?php
                                                $temp++;
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>