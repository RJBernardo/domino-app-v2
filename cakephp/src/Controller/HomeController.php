<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        // RANKING MENSAL
        $sqlMensal = "SELECT
                            G.month,
                            G.user_id,
                            U.name,
                            Count(Distinct(G.data)) as qtd_diasjogados,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                    and U.active = 'S'
                        Where year = YEAR(NOW())
                        and month = MONTH(NOW())
                        GROUP By
                            G.month,
                            G.user_id,
                            U.name
                        Having
                            Count(Distinct(G.data)) >= 8
                        Order By
                            G.month,
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_diasjogados desc,
                            qtd_win desc,
                            qtd_games desc,
                            U.name";

         // RANKING ANUAL
         $sqlAnual = "SELECT
                            G.year,
                            G.user_id,
                            U.name,
                            Count(Distinct(G.data)) as qtd_diasjogados,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                    and U.active = 'S'
                        Where year = YEAR(NOW())
                        GROUP By
                            G.year,
                            G.user_id,
                            U.name
                        Having
                            Count(Distinct(G.data)) >= 30
                        Order By
                            G.year,
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_diasjogados desc,
                            qtd_win desc,
                            qtd_games desc,
                            U.name";

        // RANKING ANUAL
        $sqlAnual = "SELECT
                            G.year,
                            G.user_id,
                            U.name,
                            Count(Distinct(G.data)) as qtd_diasjogados,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                    and U.active = 'S'
                        Where year = YEAR(NOW())
                        GROUP By
                            G.year,
                            G.user_id,
                            U.name
                        Having
                            Count(Distinct(G.data)) >= 30
                        Order By
                            G.year,
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_diasjogados desc,
                            qtd_win desc,
                            qtd_games desc,
                            U.name";
        //RANGING ACUMULADO
        $sqlAcumulado = "SELECT
                            G.user_id,
                            U.name,
                            Count(Distinct(G.data)) as qtd_diasjogados,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                    and U.active = 'S'
                        GROUP By
                            G.user_id,
                            U.name
                        Having
                            Count(Distinct(G.data)) >= 30
                        Order By
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_diasjogados desc,
                            qtd_win desc,
                            qtd_games desc,
                            U.name";

        // MERDAS
        $sqlMerdas = "SELECT
                        G.user_id,
                        U.name,
                        COUNT(Distinct(G.data)) as qtd_diasjogados,
                        Sum(G.cheat) as qtd_merdas,
                        (Sum(G.cheat) / Count(Distinct(G.data))) * 100 as Perc_Merdas
                    FROM games G
                    Join users U On U.id 	 = G.user_id
                                and U.active = 'S'
                    GROUP By
                        G.user_id,
                        U.name
                    Order By
                        Perc_Merdas desc,
                        qtd_diasjogados,
                        qtd_merdas,
                        U.name";

        // CONSULTAS
        $connection = ConnectionManager::get('default'); $resultsDiario = $this->consultaDiaria();
        $resultsSemanal = $this->consultaSemanal();
        $resultsMensal = $connection->execute($sqlMensal)->fetchAll('assoc');
        $resultsAnual = $connection->execute($sqlAnual)->fetchAll('assoc');
        $resultsAcumulado = $connection->execute($sqlAcumulado)->fetchAll('assoc');
        $resultsMerdas = $connection->execute($sqlMerdas)->fetchAll('assoc');
        $resultsDuplaDiario = $this->consultaDuplasDiario();
        $resultsDuplaGeral = $this->consultaDuplasGeral();
        $this->set(compact('resultsDiario', 'resultsSemanal', 'resultsMensal', 'resultsAnual', 'resultsAcumulado', 'resultsMerdas', 'resultsDuplaDiario', 'resultsDuplaGeral'));
    }

    // RANKING DIÁRIO
    private function consultaDiaria(){
        $date = Time::now()->i18nFormat('yyyy-MM-dd');
        if ($this->request->is('post')) {
            $date =  new Time(str_replace("/", "-", $this->request->getData('datenow')));
            $date = $date->i18nFormat('yyyy-MM-dd');
            $datenow = $this->request->getData('datenow');
            $this->set(compact('datenow'));
        }
        $sqlDiario = "SELECT
                            G.data,
                            G.user_id,
                            U.name,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                and U.active = 'S'
                        WHERE G.data = '" . $date . "'";
                        $sqlDiario .= "GROUP By
                            G.data,
                            G.user_id,
                            U.name
                        Order By
                            G.data,
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_win desc,
                            U.name";
        $connection = ConnectionManager::get('default');
        return $connection->execute($sqlDiario)->fetchAll('assoc');
    }

    // RANKING SEMANAL
    private function consultaSemanal(){
        $sqlSemanal = "SELECT
                            G.week,
                            G.user_id,
                            U.name,
                            Count(Distinct(G.data)) as qtd_diasjogados,
                            Sum(G.qtd_games) as qtd_games,
                            Sum(G.qtd_win) as qtd_win,
                            (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                            Sum(G.cheat) as qtd_merdas
                        FROM games G
                        Join users U On U.id 	 = G.user_id
                                    and U.active = 'S'
                        Where year = YEAR(NOW())
                        and week = WEEKOFYEAR(NOW())
                        GROUP By
                            G.week,
                            G.user_id,
                            U.name
                        Having
                            Count(Distinct(G.data)) >= 2
                        Order By
                            G.week,
                            Perc_Vit desc,
                            qtd_merdas,
                            qtd_diasjogados desc,
                            qtd_win desc,
                            qtd_games desc,
                            U.name";

        $connection = ConnectionManager::get('default');
        return $connection->execute($sqlSemanal)->fetchAll('assoc');
    }

    //RANKING POR DUPLAS DIÁRIO
    private function consultaDuplasDiario(){
        $date = Time::now()->i18nFormat('yyyy-MM-dd');
        if ($this->request->is('post')) {
            $date =  new Time(str_replace("/", "-", $this->request->getData('datenow')));
            $date = $date->i18nFormat('yyyy-MM-dd');
        }
        $sqlDuplasDiario = "SELECT
                                U1.Name AS Prim_User,
                                U2.Name AS Seg_User,
                                COUNT(*)/T.Tot_Part * 100  AS Perc_Vit,
                                COUNT(*) AS Part_Ganhas,
                                T.Tot_Part
                            FROM
                                games G1
                                    INNER JOIN
                                games G2 ON (G2.win = 1) AND (G2.game = G1.game)
                                    AND (G2.user_id <> G1.user_id)
                                    INNER JOIN
                                users U1 ON (U1.ID = G1.user_id)
                                    INNER JOIN
                                users U2 ON (U2.ID = G2.user_id)
                                    INNER JOIN
                                (SELECT
                                    G1.user_id AS Prim_User,
                                        G2.user_id AS Seg_User,
                                        COUNT(*) AS Tot_Part
                                FROM
                                    games G1
                                INNER JOIN games G2 ON (G2.win = G1.WIN)
                                    AND (G2.game = G1.game)
                                    AND (G2.user_id <> G1.user_id)
                                INNER JOIN users U1 ON (U1.ID = G1.user_id)
                                INNER JOIN users U2 ON (U2.ID = G2.user_id)
                                WHERE
                                    G1.type_game = 'O'
                                        AND G1.user_id = (SELECT
                                            MIN(G3.user_id)
                                        FROM
                                            games G3
                                        WHERE
                                            G3.game = G1.game AND G3.win = G1.WIN)
                                GROUP BY G1.user_id , G2.user_id
                                ORDER BY 3 DESC) AS T ON T.Prim_User = G1.user_id
                                    AND T.Seg_User = G2.user_id
                            WHERE
                                G1.data = '" . $date . "' AND
                                G1.win = 1 AND G1.type_game = 'O'
                                    AND G1.user_id = (SELECT
                                        MIN(G3.user_id)
                                    FROM
                                        games G3
                                    WHERE
                                        G3.game = G1.game AND G3.win = 1)
                            GROUP BY U1.Name , U2.Name , T.Tot_Part
                            ORDER BY 3 DESC
                            LIMIT 10";

        $connection = ConnectionManager::get('default');
        return $connection->execute($sqlDuplasDiario)->fetchAll('assoc');
    }

     //RANKING POR DUPLAS GERAL
     private function consultaDuplasGeral(){
        $sqlDuplasGeral = "SELECT
                            U1.Name AS Prim_User,
                            U2.Name AS Seg_User,
                            COUNT(*)/T.Tot_Part * 100  AS Perc_Vit,
                            COUNT(*) AS Part_Ganhas,
                            T.Tot_Part
                        FROM
                            games G1
                                INNER JOIN
                            games G2 ON (G2.win = 1) AND (G2.game = G1.game)
                                AND (G2.user_id <> G1.user_id)
                                INNER JOIN
                            users U1 ON (U1.ID = G1.user_id)
                                INNER JOIN
                            users U2 ON (U2.ID = G2.user_id)
                                INNER JOIN
                            (SELECT
                                G1.user_id AS Prim_User,
                                    G2.user_id AS Seg_User,
                                    COUNT(*) AS Tot_Part
                            FROM
                                games G1
                            INNER JOIN games G2 ON (G2.win = G1.WIN)
                                AND (G2.game = G1.game)
                                AND (G2.user_id <> G1.user_id)
                            INNER JOIN users U1 ON (U1.ID = G1.user_id)
                            INNER JOIN users U2 ON (U2.ID = G2.user_id)
                            WHERE
                                G1.type_game = 'O'
                                    AND G1.user_id = (SELECT
                                        MIN(G3.user_id)
                                    FROM
                                        games G3
                                    WHERE
                                        G3.game = G1.game AND G3.win = G1.WIN)
                            GROUP BY G1.user_id , G2.user_id
                            ORDER BY 3 DESC) AS T ON T.Prim_User = G1.user_id
                                AND T.Seg_User = G2.user_id
                        WHERE
                            G1.win = 1 AND G1.type_game = 'O'
                                AND G1.user_id = (SELECT
                                    MIN(G3.user_id)
                                FROM
                                    games G3
                                WHERE
                                    G3.game = G1.game AND G3.win = 1)
                        GROUP BY U1.Name , U2.Name , T.Tot_Part
                        ORDER BY 3 DESC
                        LIMIT 10";

        $connection = ConnectionManager::get('default');
        return $connection->execute($sqlDuplasGeral)->fetchAll('assoc');
    }
}
