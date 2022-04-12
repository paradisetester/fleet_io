export default {
	tabs: {
		"Renewables": {
			PERSONAL_ACCIDENT: {
				insurance_type: '1',
				title: 'Personal Accident'
			},
			HEALTH_INSURANCE_MEDISHIELD_LIFE: {
				insurance_type: '2',
				title: 'Health Insurance (Medishield Life)'
			},
			HEALTH_INSURANCE_PI_RIDER: {
				insurance_type: '3',
				title: 'Health Insurance (PI Rider )'
			},
			HEALTH_INSURANCE_DEDUCTIBLES_RIDER: {
				insurance_type: '4',
				title: 'Health Insurance(Deductable Rider)'
			},
			INCOME_DISABILITY: {
				insurance_type: '5',
				title: 'Income Disabilility'
			}
		},
		"OtherPlans": {
			term: {
				insurance_type: '6',
				title: 'Term'
			},
			endowment: {
				insurance_type: '7',
				title: 'Endowment'
			},
			life_plan_main_plan: {
				insurance_type: '8',
				title: 'Life Plan (Main Plan)'
			},
			life_plan_rider_plan: {
				insurance_type: '9',
				title: 'Life Plan (Rider Plan)'
			},
			annuity: {
				insurance_type: '10',
				title: 'Annuity'
			},
			ilp: {
				insurance_type: '11',
				title: 'ILP'
			}
		}
	},
	formFields: [
		{
			key: 'insured_name',
			title: 'Insured name',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'policy_holder',
			title: 'Policy Holder',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'product_name',
			title: 'Product name',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'insurer',
			title: 'Insurer',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'policy_number',
			title: 'Policy number',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'mode_of_payment',
			title: 'Mode of payment',
			type: 'select',
			default: '',
			class: '',
			event: {
				type: 'plus',
				fields: ['premium_amount_by_medisave','premium_amount_by_cash'],
				showInField: 'total_tenure'
			},
			options: [
				{
					text: 'Regular(Monthly)',
					value: 'MNT'
				},
				{
					text: 'Regular(Annual)',
					value: 'ANL'
				},
				{
					text: 'Lumpsum',
					value: 'LPS'
				}
			],
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'premium_amount_by_medisave',
			title: 'Premium amount by medisave',
			type: 'priceNumber',
			default: '',
			class: '',
			event: {
				type: 'plus',
				fields: ['premium_amount_by_medisave','premium_amount_by_cash'],
				showInField: 'total_tenure'
			},
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'premium_amount_by_cash',
			title: 'Premium amount by cash',
			type: 'priceNumber',
			default: '',
			class: '',
			event: {
				type: 'plus',
				fields: ['premium_amount_by_medisave','premium_amount_by_cash'],
				showInField: 'total_tenure'
			},
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'total_tenure',
			title: 'Total tenure',
			type: 'priceNumber',
			default: '',
			class: '',
			event: {
				type: 'plus',
				fields: ['premium_amount_by_medisave','premium_amount_by_cash'],
				showInField: 'total_tenure'
			},
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'premium_amount_by_cpf',
			title: 'Premium amount by CPF',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'OA',
					value: 'OA'
				},
				{
					text: 'SA',
					value: 'SA'
				},
				{
					text: 'SRS',
					value: 'SRS'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'date_in_force',
			title: 'Date in force',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'date_of_maturity',
			title: 'Date of maturity',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'date_of_renewal',
			title: 'Date of renewal',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'tenure_remaining',
			title: 'Tenure remaining',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'premium_term',
			title: 'Premium term',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'premium_end_date',
			title: 'Premium End Date',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'claim_criteria',
			title: 'Claim criteria',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: '2/6 ADL',
					value: 'T6'
				},
				{
					text: '3/6 ADL',
					value: 'T3'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: true,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'scope_of_coverage',
			title: 'Scope of coverage',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'disability_benefit',
			title: 'Disability benefit',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: true,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'payout_duration',
			title: 'Payout duration',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: true,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'accident_death',
			title: 'Accidental death',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'accidental_death',
			title: 'Accidental death',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'death',
			title: 'Death',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'accidental_dismemberment',
			title: 'Accidental dismemberment',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'awl_limit',
			title: 'Awl Limit',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'medical_expenses_limit',
			title: 'Medical expenses limit',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'inflation_rate',
			title: 'Inflation Rate',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'committed_amount',
			title: 'Committed amount',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'total_premium_if_throughout_tenure',
			title: 'Total premium if throughout tenure',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'premium_paid_till_date',
			title: 'Premium paid till date',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'date_when_first_payout_start',
			title: 'Date when first payout start',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'duration_of_payout',
			title: 'Duration of payout',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'estimated_retirement_payout',
			title: 'Estimated retirement payout',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'net_account_value',
			title: 'Net account value',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: true
			}
		},
		{
			key: 'dividend_option',
			title: 'Dividend option',
			type: 'select',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			options: [
				{
					text: 'Payout',
					value: 'Payout'
				},
				{
					text: 'Reinvested',
					value: 'Reinvested'
				}
			],
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: true
			}
		},
		{
			key: 'cash_bonus_option',
			title: 'Cash bonus option',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'Paid out',
					value: 'PO'
				},
				{
					text: 'Accumulated',
					value: 'AC'
				},
				{
					text: 'NA',
					value: 'NA'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'cash_bonus_amount',
			title: 'Cash bonus amount',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'net_cash_value',
			title: 'Net cash value',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'net_cash_value_include_cash_bonus',
			title: 'Net cash value include cash bonus',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: false
			}
		},
		{
			key: 'projected_account_value',
			title: 'Projected account value',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: false,
				ilp: true
			}
		},
		{
			key: 'expected_yield_to_maturity_if_whole_specify',
			title: 'Expected Yield To maturity if Wholelife specify (%)',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'expected_maturity_if_whole_specify',
			title: 'Expected Maturity if Wholelife specify ($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: true,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'minimum_commitment_period',
			title: 'Minimum Commitment Period',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: false,
				endowment: false,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: false,
				ilp: true
			}
		},
		{
			key: 'tpd',
			title: 'TPD($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'income_disability',
			title: 'Income Disability($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: false,
				life_plan_main_plan: false,
				life_plan_rider_plan: false,
				annuity: true,
				ilp: false
			}
		},
		{
			key: 'early_critical_illness',
			title: 'Early Critical Illness($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'major_critical_illness',
			title: 'Major Critical Illness($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'terminal_illness',
			title: 'Terminal Illness($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: false,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: false,
				HEALTH_INSURANCE_PI_RIDER: false,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: false,
				INCOME_DISABILITY: false,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'remarks',
			title: 'Remarks',
			type: 'textarea',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		},
		{
			key: 'managed_by',
			title: 'Managed By Self',
			type: 'checkbox',
			default: '1',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
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
				PERSONAL_ACCIDENT: true,
				HEALTH_INSURANCE_MEDISHIELD_LIFE: true,
				HEALTH_INSURANCE_PI_RIDER: true,
				HEALTH_INSURANCE_DEDUCTIBLES_RIDER: true,
				INCOME_DISABILITY: true,
				term: true,
				endowment: true,
				life_plan_main_plan: true,
				life_plan_rider_plan: true,
				annuity: true,
				ilp: true
			}
		}
	]
}