import { escapeRegexSpecialChars } from '@/helpers/strings.js';
export const rules = {
        required: (value) => {
          if (value === undefined || value.trim().length === 0) {
            return false;
          } 
          return true;
        },
        
        trimmed: (value) => {
          if (value[0] === ' ' || value[value.length - 1] === ' '){
            return false;
          }
          return true;
        },
        
        startsWith: (haystack, needle) => {
            const test = new RegExp(`^${escapeRegexSpecialChars(needle)}`);
            if (!test.test(haystack.trim())) {
               return false;
             }
          return true;
        },
        
        endsWith: (haystack, needle) => {
          const test = new RegExp(`${escapeRegexSpecialChars(needle)}$`);
            if (!test.test(haystack.trim())) {
               return false;
             }
          return true;
        },
        
        min: (value, minVal) => {
          return value >= minVal;
        },
            
        max: (value, maxVal) => {
          return value <= maxVal;
        },
        
        minLength: (value, minLengthVal) => {
          return value.length >= minLengthVal;
        },
        
        maxLength: (value, maxLengthVal) => {
          return value.length <= maxLengthVal;
        },
      };

export function parseTextRules (textRules, value, messages) {
  const rulesArr = textRules.split('|');
  const errors = {};
  for (let i = 0; i < rulesArr.length; i++) {
      const rule = rulesArr[i];
      if (rule.includes(':')) {
          const [ruleName, ruleValue] = rule.split(':');
         if (!rules[ruleName](value, ruleValue)) {
             errors[ruleName] = messages[ruleName];
             break;
         }
      } else {
          if (!rules[rule](value)) {
              errors[rule] = messages[rule];
              break;
          }
      }
  }
  return errors;
};