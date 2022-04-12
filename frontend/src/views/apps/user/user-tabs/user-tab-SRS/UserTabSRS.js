export default {
	tabs: {
		"Renewables": {
			SRS: {
				insurance_type: '1',
				title: 'SRS'
			}
		}
	},
	formFields: [
		{
			key: 'srs_agent_bank',
			title: 'SRS Agent Bank',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'DBS',
					value: 'DBS'
				},
				{
					text: 'OCBC',
					value: 'OCBC'
				},
				{
					text: 'UOB',
					value: 'UOB'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				SRS: true
			}
		},
		{
			key: 'year_for_first_contribution',
			title: 'Year For First Contribution',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				SRS: true
			}
		},
		{
			key: 'total_amount_contributed',
			title: 'Total Amount Contributed Till Date',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				SRS: true
			}
		},
		{
			key: 'amount_uninvested',
			title: 'Amount Available Uninvested',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				SRS: true
			}
		},
		{
			key: 'withdrawal_age',
			title: 'Withdrawal Age',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				SRS: true
			}
		},
		{
			key: 'withdrawn_amount',
			title: 'Withdrawn Amount',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				SRS: true
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
				SRS: true
			}
		}
	]
}