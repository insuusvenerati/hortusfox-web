<div class="columns">
	<div class="column is-2"></div>

	<div class="column is-8 is-image-container" style="background-image: url('{{ asset('img/plants.jpg') }}');">
		<div class="column-overlay">
			<h1>{{ $plant->get('name') }}</h1>

			<div class="margin-vertical">
                <a class="is-default-link" href="{{ url('/plants/location/' . $plant->get('location')) }}">{{ __('app.back_to_list') }}</a>
            </div>

			<div class="margin-vertical is-default-text-color">
				{{ __('app.last_edited_by', ['name' => $edit_user_name, 'when' => $edit_user_when]) }}
			</div>

			@if ($plant->get('health_state') !== 'in_good_standing')
				<div class="plant-warning">{{ __('app.plant_warning', ['reason' => __('app.' . $plant->get('health_state'))]) }}</div>
			@endif

			<div class="columns plant-column">
				<div class="column is-half">
					<table>
						<thead>
							<tr>
								<td>{{ __('app.attribute') }}</td>
								<td>{{ __('app.value') }}</td>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><strong>{{ __('app.name') }}</strong></td>
								<td>{{ $plant->get('name') }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditText({{ $plant->get('id') }}, 'name');"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.location') }}</strong></td>
								<td>{{ LocationsModel::getNameById($plant->get('location')) }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditCombo({{ $plant->get('id') }}, 'location', window.vue.comboLocation);"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.last_watered') }}</strong></td>
								<td>
									@if ($plant->get('last_watered'))
										{{ date('Y-m-d', strtotime($plant->get('last_watered'))) }}
									@else
										<span class="is-not-available">N/A</span>
									@endif

									<span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditDate({{ $plant->get('id') }}, 'last_watered');"><i class="fas fa-edit is-color-darker"></i></a></span>
								</td>
							</tr>

							<tr>
								<td><strong>{{ __('app.last_repotted') }}</strong></td>
								<td>
									@if ($plant->get('last_repotted'))
										{{ date('Y-m-d', strtotime($plant->get('last_repotted'))) }}
									@else
										<span class="is-not-available">N/A</span>
									@endif

									<span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditDate({{ $plant->get('id') }}, 'last_repotted');"><i class="fas fa-edit is-color-darker"></i></a></span>
								</td>
								</td>
							</tr>

							<tr>
								<td><strong>{{ __('app.perennial') }}</strong></td>
								<td>{!! ($plant->get('perennial')) ? '<span class="is-color-yes">' . __('app.yes') . '</span>' : '<span class="is-color-no">' . __('app.no') . '</span>' !!} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditBoolean({{ $plant->get('id') }}, 'perennial', '{{ __('app.perennial') }}');"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.cutting_month') }}</strong></td>
								<td>{{ UtilsModule::getMonthList()[$plant->get('cutting_month')] }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditCombo({{ $plant->get('id') }}, 'cutting_month', window.vue.comboCuttingMonth);"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.date_of_purchase') }}</strong></td>
								<td>{{ date('Y-m-d', strtotime($plant->get('date_of_purchase'))) }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditDate({{ $plant->get('id') }}, 'date_of_purchase');"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.humidity') }}</strong></td>
								<td>{{ $plant->get('humidity') . '%' }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditInteger({{ $plant->get('id') }}, 'humidity');"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.light_level') }}</strong></td>
								<td>{{ __('app.' . $plant->get('light_level')) }} <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditCombo({{ $plant->get('id') }}, 'light_level', window.vue.comboLightLevel);"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>

							<tr>
								<td><strong>{{ __('app.health_state') }}</strong></td>
								<td><span class="plant-state-{{ $plant->get('health_state') }}">{!! ($plant->get('health_state') === 'in_good_standing') ? '<i class="far fa-check-circle is-color-yes"></i>&nbsp;' : '' !!}{{ __('app.' . $plant->get('health_state')) }}</span> <span class="float-right"><a href="javascript:void(0);" onclick="window.vue.showEditCombo({{ $plant->get('id') }}, 'health_state', window.vue.comboHealthState);"><i class="fas fa-edit is-color-darker"></i></a></span></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="column is-half">
					<a href="javascript:void(0);" onclick="window.vue.showEditPhoto({{ $plant->get('id') }}, 'photo');">
						<div class="plant-photo" style="background-image: url('{{ asset('img/' . $plant->get('photo')) }}');">
							<div class="plant-photo-overlay">
								<div class="plant-photo-edit"><i class="fas fa-upload fa-4x"></i></div>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="columns plant-column">
				<div class="column is-full">
					<div class="plant-notes">
						<div class="plant-notes-content">
							@if (is_string($plant->get('notes')))
								{{ $plant->get('notes') }}
							@else
								<span class="is-not-available">N/A</span>
							@endif
						</div>

						<div class="plant-notes-edit">
							<a href="javascript:void(0);" onclick="window.vue.showEditText({{ $plant->get('id') }}, 'notes');">
								<i class="fas fa-edit is-color-darker"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="column is-2"></div>
</div>