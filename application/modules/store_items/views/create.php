 <h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>
<?php 
	if (isset($flash))
	{
		echo $flash;
	}
?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Szczegóły produktu</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php 
							$form_location = base_url()."store_items/create/".$update_id;
						?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Nazwa produktu</label>
							  <div class="controls">
									<input type="text" class="span6" name="item_title" value="<?= $item_title ?>">
							  </div>
							</div>  
							<div class="control-group">
							  <label class="control-label" for="typeahead">Cena produktu </label>
							  <div class="controls">
									<input type="text" class="span1" name="item_price" value="<?= $item_price ?>">
							  </div>
							</div>      
							<div class="control-group">
							  <label class="control-label" for="typeahead">Stara cena <span style="color: green;">(opcjonalnie)</span></label>
							  <div class="controls">
									<input type="text" class="span1" name="was_price" value="<?= $was_price ?>">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="typeahead">Status</label>
							  <div class="controls">
							  	<?php  
							  		$additiolnal_dd_code = 'id="selectError3"';
							  		$options = array(
							  											'' => 'Wybierz status produktu',
							  											'1' => 'Aktywny',
							  											'0' => 'Nieaktywny',
							  		);
							  		echo form_dropdown('status', $options, $status, $additiolnal_dd_code);
							  	?>
							  </div>
							</div>   
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Opis produktu</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="item_description"><?php echo $item_description; ?></textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Zapisz">Zapisz</button>
							  <button type="submit" class="btn" name="submit" value="Anuluj">Anuluj</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->