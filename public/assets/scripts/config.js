const config = {
  development: {
    HOME_URL: "/",
    Domain: ""
  },
  production: {
    HOME_URL: "/",
    Domain: ""
  }
};

const ENV = 'development'; // Change to 'production' when deploying

export const { HOME_URL, Domain } = config[ENV];
