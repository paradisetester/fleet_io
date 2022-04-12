export default {
	tabs: {
		"Renewables": {
			ORDINARY_ACCOUNT: {
				insurance_type: '1',
				title: 'Ordinary Account'
			},
			SPECIAL_ACCOUNT: {
				insurance_type: '2',
				title: 'Special Account'
			},
			MEDISAVE_ACCOUNT: {
				insurance_type: '3',
				title: 'Medisave Account'
			},
			RETIREMENT_ACCOUNT: {
				insurance_type: '4',
				title: 'Retirement Account'
			}
		}
	},
	formFields: [
		{
			key: 'amount_to_date',
			title: 'Amount to date',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:true,
				RETIREMENT_ACCOUNT:true
			}
		},
		{
			key: 'estimated_growth_rate',
			title: 'Estimated growth rate',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:true,
				RETIREMENT_ACCOUNT:true
			}
		},
		{
			key: 'contribution_rate',
			title: 'Contribution Rate %',
			type: 'showRate',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:true,
				RETIREMENT_ACCOUNT:false
			}
		},
		{
			key: 'contribution_amount_per_annum',
			title: 'Contribution amount per Annum',
			type: 'showCalculation',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:true,
				RETIREMENT_ACCOUNT:false
			}
		},
		{
			key: 'cpf_life_scheme',
			title: 'Cpf life scheme',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'N.A',
					value: 'N.A'
				},
				{
					text: 'STANDARD',
					value: 'STANDARD'
				},
				{
					text: 'ESCALATED',
					value: 'ESCALATED'
				},
				{
					text: 'ENHANCED',
					value: 'ENHANCED'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: false,
				SPECIAL_ACCOUNT:false,
				MEDISAVE_ACCOUNT:false,
				RETIREMENT_ACCOUNT:true
			}
		},
		{
			key: 'cpf_life_monthly_payout',
			title: 'Cpf life monthly payout @ 65',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				ORDINARY_ACCOUNT: false,
				SPECIAL_ACCOUNT:false,
				MEDISAVE_ACCOUNT:false,
				RETIREMENT_ACCOUNT:true
			}
		},
		{
			key: 'cpf_agent_bank',
			title: 'Cpfia  agent bank',
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
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:false,
				RETIREMENT_ACCOUNT:false
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
				ORDINARY_ACCOUNT: true,
				SPECIAL_ACCOUNT:true,
				MEDISAVE_ACCOUNT:true,
				RETIREMENT_ACCOUNT:true
			}
		}
	]
}