export default {
	tabs: {
		"Renewables": {
			MORTGAGE_PORTFOLIO: {
				insurance_type: '1',
				title: 'Client`s Mortgage Portfolio'
			}
		}
	},
	formFields: [
		{
			key: 'heading1',
			title: 'Property Details',
			type: 'heading',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'type_of_pty',
			title: 'Type of pty',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'HDB',
					value: 'HDB'
				},
				{
					text: 'HUDC',
					value: 'HUDC'
				},
				{
					text: 'EC',
					value: 'EC'
				},
				{
					text: 'PTE CONDO',
					value: 'PTE CONDO'
				},
				{
					text: 'LANDED TERRACE',
					value: 'LANDED TERRACE'
				},
				{
					text: 'LANDED CLUSTER',
					value: 'LANDED CLUSTER'
				},
				{
					text: 'LANDED SEMI',
					value: 'LANDED SEMI'
				},
				{
					text: 'BUNGALOW',
					value: 'BUNGALOW'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'property_address',
			title: 'Property Address',
			type: 'textarea',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'property_name',
			title: 'Property Name',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'purchase_price',
			title: 'Purchase Price',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'property_tenure',
			title: 'Property tenure',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: '99',
					value: '99'
				},
				{
					text: '999',
					value: '999'
				},
				{
					text: 'Freehold',
					value: 'F'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'type_of_account',
			title: 'Type of account',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'Single',
					value: 'S'
				},
				{
					text: 'Jointly Owned',
					value: 'J'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'joint_to',
			title: 'Joint With',
			type: 'selectProfile',
			default: '',
			class: '',
			options: [],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'heading2',
			title: 'Mortgage Details',
			type: 'heading',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'outstanding_loan',
			title: 'Outstanding Loan',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'financier',
			title: 'Financier',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'HDB',
					value: 'HDB'
				},
				{
					text: 'OCBC',
					value: 'OCBC'
				},
				{
					text: 'UOB',
					value: 'UOB'
				},
				{
					text: 'DBS',
					value: 'DBS'
				},
				{
					text: 'STANDCHART',
					value: 'STANDCHART'
				},
				{
					text: 'CITIBANK',
					value: 'CITIBANK'
				},
				{
					text: 'HONGLEONG',
					value: 'HONGLEONG'
				},
				{
					text: 'HSBC',
					value: 'HSBC'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'tenure',
			title: 'Tenure',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'loan_package',
			title: 'Loan Package',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'loan_interest',
			title: 'Loan Interest %',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'rate_review_date',
			title: 'Rate Review Date/Out Of Lock In Date',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'repayment_amount',
			title: 'Repayment by Cash(Yearly)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'repayment_amount_by_cpf',
			title: 'Repayment by CPF(Yearly)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'total_payment',
			title: 'Total Repayment',
			type: 'show_totalPayment',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'heading3',
			title: 'Other Details',
			type: 'heading',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'current_market_value',
			title: 'Current Market Value',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'rental_yield',
			title: 'Rental Yield %',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'rental_per_annum',
			title: 'Rental P. A.',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
			}
		},
		{
			key: 'growth_rate',
			title: 'Growth Rate %',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				MORTGAGE_PORTFOLIO: true
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
				MORTGAGE_PORTFOLIO: true
			}
		}
	]
}