let yearOptions = [];
var newDate = new Date();
for (var i = 1970; i <= (newDate.getFullYear()+14); i++) {
	var option = {text: i, value:i};
	yearOptions.push(option);
}
export default {
	tabs: {
		"Renewables": {
			Cash_Flow: {
				insurance_type: '1',
				title: 'Expenditure'
			}
		}
	},
	formFields: [		
		{
			key: 'yearly_expenditure',
			title: 'Yearly Expenditure',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				Cash_Flow: true
			}
		},
		{
			key: 'inflation_rate',
			title: 'Inflation Rate',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				Cash_Flow: true
			}
		},
		{
			key: 'start_date',
			title: 'Start Date',
			type: 'select',
			default: '',
			class: '',
			options: yearOptions,
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				Cash_Flow: true
			}
		},
		{
			key: 'end_date',
			title: 'End Date',
			type: 'select',
			default: '',
			class: '',
			options: yearOptions,
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				Cash_Flow: true
			}
		},
		{
			key: 'action',
			title: 'Actions',
			type: 'link',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: false
			},
			tab: {
				Cash_Flow: true
			}
		}
	]
}