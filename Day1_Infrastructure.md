# 🛠️ [Day 1] 타겟 시스템(인트라넷 및 금융 DB) 환경 구축

## 1. 실습 목표
해커의 공격 대상이 될 가상의 '은행 직원용 인트라넷'을 직접 구축한다. 로그인 기능과 고객 조회 API를 구현하되, 인가(Authorization) 검증 로직을 고의로 누락시켜 취약한 환경을 구성한다.

## 2. 데이터베이스 및 서버 아키텍처
* **환경**: Rocky Linux 9, Apache 웹 서버, MariaDB
* **DB 설계**: `employees`(직원 정보), `customers`(고객 정보), `relations`(담당 고객 매핑) 3개의 테이블을 설계하여 실제 은행 업무 시스템과 유사한 관계형 데이터베이스 구축.

> <img width="774" height="144" alt="image" src="https://github.com/user-attachments/assets/b4461ccb-7f58-4a47-aaf9-fe21e9ff5b71" />


## 3. 사내 인트라넷 구축 결과
* `index.php`를 통해 직원 사번(`emp001`)과 비밀번호(`1234`)로 세션(Session) 기반 로그인을 구현함.
* `dashboard.php`에서 버튼 클릭 시 `api_lookup.php`를 호출하여 정상적으로 영어로 된 담당 고객 데이터를 JSON 형태로 반환받음.

> <img width="686" height="294" alt="image" src="https://github.com/user-attachments/assets/8910c888-bbb3-4254-8f88-b11c4b12dbb2" />
> <img width="1267" height="361" alt="image" src="https://github.com/user-attachments/assets/9de6229a-2981-4cd3-a037-8b1f56b79ba5" />


## 4. 💡 보안 취약점 포인트 (IDOR)
오늘 구현한 백엔드 API(`api_lookup.php`)에는 치명적인 논리적 결함이 있다. 시스템에 로그인했는지(인증)는 검증하지만, **"요청한 직원이 해당 고객 정보를 조회할 권한이 있는지(인가)"**는 확인하지 않는다. 
다음 단계에서는 이 결함을 악용하여 타인의 금융 데이터를 탈취하는 공격을 수행할 예정이다.
